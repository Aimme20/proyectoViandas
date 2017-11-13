

<div class="container">
  
  <div class="switchery-demo">
    <a class="switchtabla">
        <?php
        if(isset($_POST['state']))
          $ver_por_fecha = $_POST['state'];
        else 
          $ver_por_fecha = 0;
        
        if($ver_por_fecha == 1)
          echo "<input id='switchvistatabla' type='checkbox' checked data-plugin='switchery' data-color='#039cfd'/>";
        else
          echo "<input id='switchvistatabla' type='checkbox' data-plugin='switchery' data-color='#039cfd'/>";
      ?>
    </a>
    <label>Ver por fecha</label>
    
  </div>

<?php
ini_set('display_errors', 'On');ini_set('display_errors', 1);
  require_once "../modelo.php";
  $db=new BaseDatos();

  $query = "select v.id, v.fecha,  p.nombre as producto, tp.nombre as tipo, vp.cantidad, p.precio_venta, p.precio_compra, tp.impuesto 
  from venta as v 
  inner join venta_producto as vp on vp.idVenta = v.id 
  inner join producto as p on p.id = vp.idProducto 
  inner join tipo_producto as tp on tp.id=p.tipo 
  where v.fecha < DATE_ADD(CURDATE(), INTERVAL 30 DAY) order by v.id;";
  $table = $db->db->query($query);
  $table = $table->fetch_all(MYSQLI_ASSOC);
  
  $i=0;
  $ventaActual = "0";
  $utilidad_total = 0;
  $ingreso_total = 0;
  $inversion_mes = 0;
  
   
  
  if($ver_por_fecha == 0){
      
      echo"      
      <div class='row'>
          <div class='col-sm-12'>
              <h4 class='header-title m-t-0 m-b-20'>VENTAS DEL MES</h4>
          </div>
      </div> <!-- end row -->
        <table id='datatable-buttons' class='table table-striped table-bordered'>
          <thead>
              <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Tipo</th>
                  <th>Cant</th>
                  <th>Compra</th>
                  <th>Venta</th>
                  <th>Impuestos / Total</th>
                  <th>Importe Total</th>
                  <th>Inversión</th>
                  <th>Utilidad</th>
              </tr>
          </thead>
      ";
    }
  foreach($table as $a){
    
    
    if($ventaActual != $a['id'] && $i!=0 && $ver_por_fecha != 0){
      echo "
        </tbody>
      </table>
      ";
    }
    if($ventaActual != $a['id'] && $ver_por_fecha != 0){
      $ventaActual = $a['id'];
      $i++;      
      
      echo "
      <div class='row'>
          <div class='col-sm-12'>
              <h4 class='header-title m-t-0 m-b-20'>".$a['fecha']."</h4>
          </div>
      </div> <!-- end row -->";
      
      echo"
        <table id='datatable-buttons-$i' class='table table-striped table-bordered'>
          <thead>
              <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Tipo</th>
                  <th>Cant</th>
                  <th>A la Compra</th>
                  <th>A la Venta</th>
                  <th>Impuestos / Total</th>
                  <th>Importe T</th>
                  <th>Inversión</th>
                  <th>Utilidad</th>
              </tr>
          </thead>
      ";
    }
    
    echo "<tr>";
    echo   "<th scope='row'>".$a['id']."</th>";
    echo   "<td>".$a['producto']."</td>";
    echo   "<td>".$a['tipo']."</td>";
    echo   "<td>".$a['cantidad']."</td>";
    echo   "<td>$ ".sprintf("%.2f", $a['precio_compra'])."</td>";
    echo   "<td>$ ".sprintf("%.2f", $a['precio_venta'])."</td>";
    echo   "<td>".sprintf("%.2f", $a['impuesto']) ." % = $ ".sprintf("%.2f", ($a['precio_venta']*$a['impuesto']/100))."</td>";
    echo   "<td>$ ".sprintf("%.2f", $a['cantidad'] * ($a['precio_venta']) +($a['precio_venta']*$a['impuesto']/100) )."</td>";
    echo   "<td>$ ".sprintf("%.2f", $a['precio_compra']*$a['cantidad'])."</td>";
    echo   "<td>$ ".sprintf("%.2f", ($a['cantidad'] * $a['precio_venta'])-$a['precio_compra'] )."</td>";
    echo "</tr>";
    $utilidad_total += ($a['cantidad'] * $a['precio_venta'])-$a['precio_compra'];
    $ingreso_total += $a['cantidad'] * ($a['precio_venta']) +($a['precio_venta']*$a['impuesto']/100);
    $inversion_mes += $a['precio_compra'];
  }
    echo "
        </tbody>
      </table>
      ";

?>
  <div class="col-md-4">
      <div class="card-box">
        <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" 
           data-original-title="Representa el total de lo que se pago para adquirir todos los productos (sumatoria de los precios de compra)."></i>
        <h4 class="m-t-0 text-dark">Inversión del Mes:</h4>
        <h2 class="text-dark text-center m-b-30 m-t-30">$<span data-plugin="counterup"><?php echo sprintf('%.2f', $inversion_mes);?></span></h2>
      </div>
  </div>
  <div class="col-md-4">
      <div class="card-box">
        <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" 
           data-original-title="Representa el total de lo que ha ingresado, es la sumatora de los precios de venta (incluyendo impuestos)."></i>
        <h4 class="m-t-0 text-dark">Ingresos del mes:</h4>
        <h2 class="text-info text-center m-b-30 m-t-30">$<span data-plugin="counterup"><?php echo sprintf("%.2f",$ingreso_total)?></span></h2>
      </div>
  </div>
  <div class="col-md-4">
      <div class="card-box">
        <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" 
           data-original-title="Representa el total de lo ganado para el negocio, descuenta la inversión y el pago de impuestos."></i>
        <h4 class="m-t-0 text-dark">Utilidad del mes:</h4>
        <h2 class="text-success text-center m-b-30 m-t-30">$<span data-plugin="counterup"><?php echo sprintf("%.2f",$utilidad_total)?></span></h2>
      </div>
  </div>

</div>


<!-- init -->
<script src="../assets/pages/jquery.datatables.init.js"></script>
<!-- App Js -->
<script src="../assets/js/jquery.app.js"></script>


