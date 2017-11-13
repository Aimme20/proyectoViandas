<div class="container">
  <div class="row">
      <div class="col-sm-12">
          <h4 class="header-title m-t-0 m-b-20">Proveedores</h4>
      </div>
  </div> <!-- end row -->

  <?php
		include_once "modelo.php";
    $db = new BaseDatos();
          
    $query = "select * from proveedor;";
    $result = $db->db->query($query);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $i=1;
    foreach($result as $a){
      if($i%3==0){
        echo "<div class='row'>";
      }
      
      echo "
      <div class='col-md-4'>
      <div class='text-center card-box'>
              <div class='dropdown pull-right'>
                  <a href='#' class='dropdown-toggle card-drop' data-toggle='dropdown' aria-expanded='false'>
                      <h3 class='m-0 text-muted'><i class='mdi mdi-dots-horizontal'></i></h3>
                  </a>
                  <ul class='dropdown-menu' role='menu'>
                      <li><a class='editarproveedor' id='".$a['id']."'>Modificar</a></li>
                      <li><a class='borrarproveedor' id='".$a['id']."'>Borrar</a></li>
                  </ul>
              </div>
              <div class='clearfix'></div>
              <div class='member-card'>";

      echo"    
                  <div>
                      <h4 class='m-b-5'>".$a['nombre']."</h4>
                      <p class='text-muted'>RFC@<span> | </span> <span> <a href='#' class='text-pink'>".$a['RFC']."</a> </span></p>
                  </div>

                  <p class='text-muted font-13'>
                      
                  </p>

                  <ul class='social-links list-inline m-t-30'>
                      <li>
                          <a title='' data-placement='top' data-toggle='tooltip' class='tooltips' href='' data-original-title='Facebook'><i class='fa fa-facebook'></i></a>
                      </li>
                      <li>
                          <a title='' data-placement='top' data-toggle='tooltip' class='tooltips' href='' data-original-title='Twitter'><i class='fa fa-twitter'></i></a>
                      </li>
                      <li>
                          <a title='' data-placement='top' data-toggle='tooltip' class='tooltips' href='' data-original-title='Skype'><i class='fa fa-skype'></i></a>
                      </li>
                  </ul>

              </div>

          </div>

      </div> <!-- end col -->
      ";
      
      
      if($i%3==0){
        echo "</div>";
      }
      
      $i++;
    }
  ?>

	
	<?php
	session_start();
		$idUsuario = $_SESSION['USUARIO'];
		$query = "select p.id as idTipo from empleado as e inner join tipo_empleado as p on p.id=tipo where e.id = $idUsuario;";
    $result = $db->db->query($query);
    $result = $result->fetch_all(MYSQLI_ASSOC);
		$tipo = $result[0]['idTipo'];
		if($tipo == "1"){
			echo "
			<div class='row'>
				<div class='col-sm-12 text-center'>
					<a class='nuevoproveedor'>
						<button class='btn btn-primary btn-rounded btn-lg m-b-30' data-toggle='modal' data-target='#add-contact'>Nuevo Proveedor</button>
					</a>
				</div>
			</div>
			";
		}
?>

  
  
</div>


<script>
$(document).on('click', 'a.nuevoproveedor', function (event) {
  $.ajax({  
      url: "proveedor/nuevo_proveedor.php",  
      success: function(data) {  
          $('#contenido').html(data);  
      }  
    });
});
  
$(document).on('click', 'a.cancelarproveedor', function (event) {
  $.ajax({  
      url: "proveedores.php",  
      success: function(data) {  
          $('#contenido').html(data);  
      }  
    });
});
</script>