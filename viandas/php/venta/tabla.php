<?php
  require_once "../modelo.php";
  $db=new BaseDatos();
?>
<h5>En esta venta <pedido></pedido></h5>

<table class="table">
  <thead>
      <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Tipo</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Impuesto</th>
          <th>Importe Total</th>
          <th></th>
          <th></th>
      </tr>
  </thead>
  <tbody>
    <?php
      $query = "select p.nombre as producto, tp.nombre as tipo, p.precio_venta as precio, v.cantidad as cantidad, tp.impuesto
        from venta_temporal as v inner join producto as p on p.id=v.idProducto 
        inner join tipo_producto as tp on tp.id=p.tipo;";
      $table = $db->db->query($query);
      $table = $table->fetch_all(MYSQLI_ASSOC);
      $i=0;
      $sin_impuesto = 0;
      $con_impuesto = 0;
      $impuestos = 0;

      foreach ($table as $a){
        $i+=1;
        
        if($a['tipo']=="Bebida")
          $tipe = "info";
        else if($a['tipo']=="Plato Fuerte")
          $tipe = "danger";
        else if($a['tipo']=="Aperitivo")
          $tipe = "warning";
        
        echo "<tr class='$tipe'>";
        echo   "<th scope='row'>$i</th>";
        echo   "<td>".$a['producto']."</td>";
        echo   "<td>".$a['tipo']."</td>";
        echo   "<td>".$a['cantidad']."</td>";
        echo   "<td>$ ".sprintf("%.2f", $a['precio'])."</td>";
        echo   "<td>".sprintf("%.2f", $a['impuesto']) ." %</td>";
        echo   "<td>$ ".sprintf("%.2f", $a['cantidad'] * ($a['precio']) +($a['precio']*$a['impuesto']/100) )."</td>";
        echo   "<td><a class='mas'><IMG SRC='../assets/images/mas.png' WIDTH=20 HEIGHT=20 BORDER=2 ALT='Mas'></a></td>";
        echo   "<td><a class='menos'><IMG SRC='../assets/images/menos.png' WIDTH=20 HEIGHT=20 BORDER=2 ALT='Menos'></a></td>";
        echo "</tr>";

        // CALCULOS BERGAS
        $sin_impuesto += $a['cantidad'] * $a['precio'];
        $con_impuesto += $a['cantidad'] * ($a['precio']) +($a['precio']*$a['impuesto']/100);
        $impuestos += $a['impuesto'];

      }
    ?>

  </tbody>
</table>

<div class="row">
    
    <div class="col-sm-4">
      <a class="botonpedorro">
        <!--button type="button" class="btn btn-default waves-effect waves-light btn-sm" id="sa-success">VENDER YA APASIN</button-->
        <button type="button" class="btn btn-success">VENDER YA APASIN</button>
      </a>
    </div>
     <div class="col-md-4">
        <div class="card-box">
          <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descripción de montos"></i>
          <h4 class="m-t-0 text-dark">Desglose</h4>
          <h2 class="text-success text-center m-b-30 m-t-30">$<span data-plugin="counterup"><?php echo sprintf('%.2f', $sin_impuesto);?></span></h2>
          <p class="m-b-0 text-muted">Ahorro total: $<?php echo sprintf('%.2f', $sin_impuesto-$con_impuesto);?> <span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i>
            <?php echo sprintf('%.2f', $impuestos/$i)." %";?></span></p>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card-box">
          <a class="btn btn-sm btn-default pull-right" id="cancelarventa">Cancelar</a>
            <h6 class="text-muted m-t-0 text-uppercase">Total</h6>
            <h2 class="m-b-20">$<span><?php echo sprintf('%.2f', $con_impuesto);?></span></h2>
            <div class="progress progress-sm m-0">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;">
                    <span class="sr-only">77% Complete</span>
                </div>
            </div>
        </div>
    </div>
  </div>