<div class="container">
  
  <?php
    require_once "modelo.php";
    $db=new BaseDatos();
  ?>

  <div class='row'>
      <div class='col-sm-12'>
        <h4 class='header-title m-t-0 m-b-20'>PRODUCTOS</h4>
      </div>
  </div> <!-- end row -->

  <table id='datatable-buttons' class='table table-striped table-bordered'>
    <thead>
        <tr>
            <th>#</th>
            <th>Producto</th>
            <th>Tipo</th>
            <th>Existencia</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
      <?php
        $query = "select p.nombre as producto, p.existencia, tp.nombre as tipo from producto as p 
        inner join tipo_producto as tp on tp.id = p.tipo";
        $table = $db->db->query($query);
        $table = $table->fetch_all(MYSQLI_ASSOC);
        $i=0;
        $productosTotales = 0;
        
        foreach ($table as $a){
          $i+=1;

          echo "<tr class='default'>";
          echo   "<td>$i</th>";
          echo   "<td>".$a['producto']."</td>";
          echo   "<td>".$a['tipo']."</td>";
          echo   "<td>".$a['existencia']."</td>";
          echo   "<td><a class='mas_productos'><IMG SRC='../assets/images/mas.png' WIDTH=22 HEIGHT=22 BORDER=2 ALT='Mas'></a></td>";
          echo "</tr>";
          
          $productosTotales += $a['existencia'];
        }
      ?>

    </tbody>
  </table>
  
  <div class="row">
    <div class="col-md-4">
      <div class="card-box">
        <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" 
           data-original-title="Es la sumatoria de todos los articulos en existencia."></i>
        <h4 class="m-t-0 text-dark">Total de productos:</h4>
        <h2 class="text-dark text-center m-b-30 m-t-30"><span data-plugin="counterup"><?php echo "** ".$productosTotales." **";?></span></h2>
      </div>
    </div>
    <div class="col-md-4">
      <a class="nuevo_producto">
        <button type="button" class="btn btn-primary">Nuevo Producto</button>
      </a>
    </div>
  </div>
  <div id="modal"></div>
</div>



<!-- init -->
<script src="../assets/pages/jquery.datatables.init.js"></script>
<!-- form advanced init js -->
<script src="../assets/pages/jquery.form-advanced.init.js"></script>
<!-- App Js -->
<script src="../assets/js/jquery.app.js"></script>

