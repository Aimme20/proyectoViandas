


<?php
  ini_set('display_errors', 'On');ini_set('display_errors', 1);
  require_once "modelo.php";
  $db=new BaseDatos();
?>


<div class="container">
  
  <div class="row">
      <div class="col-sm-12">
          <h4 class="header-title m-t-0 m-b-20">Caja</h4>
      </div>
  </div> <!-- end row -->
  
  <select class="form-control select2" id="productos">
      <option>Producto</option>

    <?php
      $query = "select p.id, p.nombre as producto, tp.nombre as tipo from producto as p 
        inner join tipo_producto as tp on tp.id = p.tipo where p.existencia > 0 order by tp.nombre;";
      $productos = $db->db->query($query);
      $productos = $productos->fetch_all(MYSQLI_ASSOC);
      $i=0;
      foreach ($productos as $a) {
        if($i == 0){
          $tipoActual = $a['tipo'];
          echo "<optgroup label='$tipoActual'>";
        }
        if($a['tipo'] != $tipoActual){
          echo "</optgroup>";
          $tipoActual = $a['tipo'];
          echo "<optgroup label='$tipoActual'>";
        }
        $value = $a['id'];
        $prod = $a['producto'];
        echo "<option value='$value'>$prod</option>";
        $i += 1;
      } 
      echo "</optgroup>";
    ?>
    
  </select>
  
  <div class="m-b-20" id="tabla">  </div>
  
  <div id="modal_venta">	</div>
  
  
  <!-- script mamalon para la busqueda -->
<script>
  $(document).ready(function() {
    $('#tabla').load("venta/tabla.php");  

    $('select#productos').on('change',function(){
      var idProducto = $(this).val();
      console.log(idProducto);

      var url = "venta/insert_tmp_venta.php";  
      $.ajax({
        type: "POST",
        url: url,
        data: {"idProducto":idProducto},
        success: function() {
          console.log("success");
          $('#tabla').load("venta/tabla.php");  
        }

      }); //Term<
    });
  });
  
		
  $(document).ready(function(){
    $('body').on('click', '#cancelarventa', function(){
      console.log("cancel");
      var url = "venta/cancelar_venta.php";  
      $.ajax({
        type: "POST",
        url: url,
        data: {"dummy":"dummy"},
        success: function() {
            $('#tabla').load("venta/tabla.php");
            $('#head').load("head.php");
        }

      });
    })
  })
</script>
  
  
</div>



<!-- form advanced init js -->
<script src="../assets/pages/jquery.form-advanced.init.js"></script>

<!-- App Js -->
<script src="../assets/js/jquery.app.js"></script>

