<div class="container">
<?php
  require_once "modelo.php";
  $db=new BaseDatos();
?>


<h6 class="m-t-30">SELECCIONA TIPO DE INVENTARIO</h6>
<div class="btn-group">
  <?php
    if(isset($_POST['tipoInventario']))
      $tipoInventario = $_POST['tipoInventario'];
    else
      $tipoInventario = 3;
    
    echo "<script>var tipoInventario = $tipoInventario;</script>";
  
  switch($tipoInventario){
      case 1:
        echo "<button id='inventarios_articulosescasos' type='button' class='btn btn-info' >ARTICULOS ESCASOS</button>
              <button id='inventarios_articulosadquiridos' type='button' class='btn btn-default'>RECIEN ADQUIRIDOS</button>
              <button id='inventarios_general' type='button' class='btn btn-default'>INVENTARIO GENERAL</button>";
        break;
      case 2:
        echo "<button id='inventarios_articulosescasos' type='button' class='btn btn-default' >ARTICULOS ESCASOS</button>
              <button id='inventarios_articulosadquiridos' type='button' class='btn btn-info'>RECIEN ADQUIRIDOS</button>
              <button id='inventarios_general' type='button' class='btn btn-default'>INVENTARIO GENERAL</button>";
        break;
      case 3:
        echo "<button id='inventarios_articulosescasos' type='button' class='btn btn-default' >ARTICULOS ESCASOS</button>
              <button id='inventarios_articulosadquiridos' type='button' class='btn btn-default'>RECIEN ADQUIRIDOS</button>
              <button id='inventarios_general' type='button' class='btn btn-info'>INVENTARIO GENERAL</button>";
        break;
    }
  ?>
    
</div>
  
<dir class="row"></dir>

<?php
  switch($tipoInventario ){
    case 1:
      $query = "select p.nombre as producto, t.nombre as tipo, p.existencia as cantidad, pr.nombre as proveedor from producto as p 
      inner join tipo_producto as t on t.id=p.tipo 
      inner join proveedor_producto as pp on p.id = pp.idProducto
      inner join proveedor as pr on pr.id = pp.idProveedor
      where p.existencia < 6;";
      break;
    case 2:
      $query = "select p.nombre as producto, t.nombre as tipo, p.existencia as cantidad, pr.nombre as proveedor from producto as p 
      inner join tipo_producto as t on t.id=p.tipo 
      inner join proveedor_producto as pp on p.id = pp.idProducto
      inner join proveedor as pr on pr.id = pp.idProveedor;";
      break;
    case 3:
      $query = "select p.nombre as producto, t.nombre as tipo, p.existencia as cantidad, pr.nombre as proveedor, 
      p.precio_venta, p.precio_compra
      from producto as p 
      inner join tipo_producto as t on t.id=p.tipo 
      inner join proveedor_producto as pp on p.id = pp.idProducto
      inner join proveedor as pr on pr.id = pp.idProveedor;";
      break;
  }
  $table = $db->db->query($query);
  $table = $table->fetch_all(MYSQLI_ASSOC);


  echo "
    <div class='row'>
        <div class='col-sm-12'>";

    switch($tipoInventario){
      case 1:
        echo "<h4 class='header-title m-t-0 m-b-20'>ARTICULOS ESCASOS</h4>";
        break;
      case 2:
        echo "<h4 class='header-title m-t-0 m-b-20'>ARTICULOS RECIEN ADQUIRIDOS</h4>";
        break;
      case 3:
        echo "<h4 class='header-title m-t-0 m-b-20'>INVENTARIO GENERAL</h4>";
        break;
    }
  echo"
        </div>
    </div> <!-- end row -->

    <table id='datatable-buttons' class='table table-striped table-bordered'>
      <thead>
          <tr>";
    switch($tipoInventario){
      case 1:
        echo "<th>#</th>
              <th>Producto</th>
              <th>Tipo</th>
              <th>Proveedor</th>
              <th>Cantidad Disponible</th>";
        break;
      case 2:
        echo "<th>#</th>
              <th>Producto</th>
              <th>Tipo</th>
              <th>Proveedor</th>
              <th>Cantidad Disponible</th>";
        break;
      case 3:
        echo "
              <th>Producto</th>
              <th>Tipo</th>
              <th>Proveedor</th>
              <th>Cantidad Disponible</th>
              <th>Valor Unitario (Compra)</th>
              <th>Valor Unitario (Venta)</th>
              <th>Valor Invertido</th>
              <th>Valor de Venta</th>
              <th>Utilidad</th>
              <th>% Utilidad (Sin impuesto)</th>";
        break;
    }
              
  echo"   </tr>
      </thead>
      <tbody>
  ";


  $i=0;
  foreach ($table as $a){
    $i++;
    
    switch($tipoInventario){
      case 1:
        echo "<tr>";
        echo   "<th scope='row'>$i</th>";
        echo   "<td>".$a['producto']."</td>";
        echo   "<td>".$a['tipo']."</td>";
        echo   "<td>".$a['proveedor']."</td>";
        echo   "<td>".$a['cantidad']."</td>";
        echo "</tr>";
        break;
      case 2:
        echo "<tr>";
        echo   "<th scope='row'>$i</th>";
        echo   "<td>".$a['producto']."</td>";
        echo   "<td>".$a['tipo']."</td>";
        echo   "<td>".$a['proveedor']."</td>";
        echo   "<td>".$a['cantidad']."</td>";
        echo "</tr>";
        break;
      case 3:
        echo "<tr>";
        echo   "<td>".$a['producto']."</td>";
        echo   "<td>".$a['tipo']."</td>";
        echo   "<td>".$a['proveedor']."</td>";
        echo   "<td>".$a['cantidad']."</td>";
        echo   "<td>$ ".sprintf("%.2f", $a['precio_compra'])."</td>";
        echo   "<td>$ ".sprintf("%.2f", $a['precio_venta'])."</td>";
        echo   "<td>$ ".sprintf("%.2f", $a['precio_compra']*$a['cantidad'])."</td>";
        echo   "<td>$ ".sprintf("%.2f", $a['precio_venta']*$a['cantidad'])."</td>";
        $utilidad = ($a['precio_venta']*$a['cantidad'])-($a['precio_compra']*$a['cantidad']);
        echo   "<td>$ ".sprintf("%.2f", $utilidad)."</td>";
        echo   "<td>$ ".sprintf("%.2f", ($utilidad/($a['precio_compra']*$a['cantidad']))*100)." %</td>";
        echo "</tr>";
        break;
    }
    
    
    

  }
  echo "
    </tbody>
  </table>
  ";

?>
</div>



<script>
$("#inventarios_articulosescasos").click(function() {
  tipoInventario = 1;
  var url = "inventarios.php";  
    $.ajax({
      type: "POST",
      url: url,
      data: {"tipoInventario":tipoInventario},
      success: function(data) {
          $('#contenido').html(data);
      }

    });
});
  
$("#inventarios_articulosadquiridos").click(function() {
  tipoInventario = 2;
  var url = "inventarios.php";  
    $.ajax({
      type: "POST",
      url: url,
      data: {"tipoInventario":tipoInventario},
      success: function(data) {
          $('#contenido').html(data);
      }

    });
});
  
$("#inventarios_general").click(function() {
  tipoInventario = 3;
  var url = "inventarios.php";  
    $.ajax({
      type: "POST",
      url: url,
      data: {"tipoInventario":tipoInventario},
      success: function(data) {
          $('#contenido').html(data);
      }

    });
});
</script>


  <!-- init -->
        <script src="../assets/pages/jquery.datatables.init.js"></script>
