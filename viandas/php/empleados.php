<div class="container">
  <div class="row">
      <div class="col-sm-12">
          <h4 class="header-title m-t-0 m-b-20">Empleados</h4>
      </div>
  </div> <!-- end row -->

  <?php
	//ini_set('display_errors', 'On');ini_set('display_errors', 1);
		include_once "modelo.php";
    $db = new BaseDatos();
          
    $query = "select e.id, p.id as idTipo, p.nombre as tipo, concat(e.nombre, ' ', e.apellidos) as nombre, p.nombre as tipo, e.correo, e.sueldo
		from empleado as e inner join tipo_empleado as p on p.id=tipo ";
    $result = $db->db->query($query);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $i=1;
    foreach($result as $a){
      if($i%3==0){
        echo "<div class='row'>";
      }
      
      echo "
      <div class='col-md-4'>
      <div class='text-center card-box'>";
			session_start();
			$idUsuario = $_SESSION['USUARIO'];
			$query = "select p.id as idTipo from empleado as e inner join tipo_empleado as p on p.id=tipo where e.id = $idUsuario;";
			$result = $db->db->query($query);
			$result = $result->fetch_all(MYSQLI_ASSOC);
			$tipo = $result[0]['idTipo'];
			
			$query = "select AVG(calificacion) as cal from venta where empleado = ".$a['id'].";";
			$result = $db->db->query($query);
			$result = $result->fetch_all(MYSQLI_ASSOC);	
			$cal = $result[0]['cal'];
			if($cal == null) $cal = "0 debido a que no he realizado ninguna venta";
			if($tipo=="1"){
			echo "
              <div class='dropdown pull-right'>
                  <a href='#' class='dropdown-toggle card-drop' data-toggle='dropdown' aria-expanded='false'>
                      <h3 class='m-0 text-muted'><i class='mdi mdi-dots-horizontal'></i></h3>
                  </a>
                  <ul class='dropdown-menu' role='menu'>
                      <li><a class='editarempleado' id='".$a['id']."'>Modificar</a></li>
                      <li><a class='borrarempleado' id='".$a['id']."'>Borrar</a></li>
                  </ul>
              </div>";
			}
			echo"  <div class='clearfix'></div>
              <div class='member-card'>";
			
				if($a['idTipo']=="1") echo "<span class='user-badge bg-warning'>".$a['tipo']."</span>";
				else 									echo "<span class='user-badge bg-custom'>".$a['tipo']."</span>";
			
        echo"     <div class='thumb-xl member-thumb m-b-10 center-block'>
                      <img src='profile_picture.php?id=".$a['id']."' class='img-circle img-thumbnail' alt='profile-image'>
                      <i class='mdi mdi-information-outline member-star text-success' title='Es jotillo XD'></i>
                  </div>

                  <div>
                      <h4 class='m-b-5'>".$a['nombre']."</h4>
                      <p class='text-muted'>Base@$".$a['sueldo']."<span> | </span> <span> <a href='#' class='text-pink'>".$a['correo']."</a> </span></p>
                  </div>

                  <p class='text-muted font-13'>
                      Hola, soy ".$a['nombre']." y recibo un pobre salario de ".sprintf("%.1f", $a['sueldo']).
											" a pesar de ser calificado por los clientes con un promedio de ".sprintf("%.1f", $cal)."
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
	
		if($tipo == "1"){
			echo "
			<div class='row'>
				<div class='col-sm-12 text-center'>
					<a class='nuevoempleado'>
						<button class='btn btn-primary btn-rounded btn-lg m-b-30' data-toggle='modal' data-target='#add-contact'>Nuevo Empleado</button>
					</a>
				</div>
			</div>
			";
		}
?>
	
  
  
</div>


<script>
	
$(document).on('click', 'a.nuevoempleado', function (event) {
	idEmpleado = 0;
  $.ajax({  
      url: "empleado/nuevo_empleado.php",  
      success: function(data) {  
          $('#contenido').html(data);  
      }  
    });
});
  
$(document).on('click', 'a.cancelarempleado', function (event) {
  $.ajax({  
      url: "empleados.php",  
      success: function(data) {  
          $('#contenido').html(data);  
      }  
    });
});
  

</script>