<!-- Plugins css-->
<link href="../assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/plugins/switchery/switchery.min.css">
<link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="../assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="../assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
<link href="../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- Summernote css -->
<link href="../assets/plugins/summernote/summernote.css" rel="stylesheet" />

<!-- Sweet Alert -->
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">




<?php
ini_set('display_errors', 'On');ini_set('display_errors', 1);
  $idEmpleado = 0;
  if(isset($_POST['idEmpleado'])){
    $idEmpleado = $_POST['idEmpleado'];
    include_once "../modelo.php";
    $db = new BaseDatos();
          
    $query = "select * from empleado where id = $idEmpleado;";
    $result = $db->db->query($query);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $a = $result[0];
  }
?>



<div class="container">
  <div class="col-lg-1"></div>

  <div class="col-lg-10">
      <div class="p-20 m-b-20">

          <h4 class="header-title m-t-0">Registro de usuarios</h4>
          <p class="text-muted font-13 m-b-10">
              Como administrador del sistema puedes registrar nuevos empleados en tu sistema. Llena debidamente los campos.
          </p>

          <div class="p-20 m-b-20">
      
              <form action="#" class="form-validation">
                
                  <div class="form-group">
                      <label class="col-md-2 control-label">Nombre</label>
                          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" 
                                 <?php
                                    if($idEmpleado!=0) echo "value='".$a['nombre']."' ";
                                 ?></input>
                  </div>
                  <div class="form-group">
                      <label class="col-md-2 control-label">Apellido</label>
                          <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido"
                                 <?php
                                    if($idEmpleado!=0) echo "value='".$a['apellidos']."' ";
                                 ?>>
                  </div>
                  <div class="form-group">
                      <label for="userName">User Name<span class="text-danger">*</span></label>
                      <input type="text" name="nick" id="username" parsley-trigger="change" required
                             placeholder="Enter user name" class="form-control" id="userName"
                             <?php
                                if($idEmpleado!=0) echo "value='".$a['username']."' ";
                             ?>>
                  </div>
                  <div class="form-group">
                      <label for="emailAddress">Email<span class="text-danger">*</span></label>
                      <input type="email" name="email" id="email" parsley-trigger="change" required
                             placeholder="Enter email" class="form-control" id="emailAddress"
                             <?php
                                if($idEmpleado!=0) echo "value='".$a['correo']."' ";
                             ?>>
                  </div>
                  <div class="form-group">
                      <label for="pass1">Contraseña<span class="text-danger">*</span></label>
                      <input id="password" type="password" placeholder="Password" required
                             class="form-control" name="password">
                  </div>
                  <div class="form-group">
                      <label for="passWord2">Confirmar Contraseña <span class="text-danger">*</span></label>
                      <input data-parsley-equalto="#pass1" type="password" required
                             placeholder="Password" class="form-control" id="confirm" name="confirm">
                  </div>
                  <div class="form-group">
                    <select class="form-control select2" id="selecttipoempleado">
                      <option>Tipo de empleado</option>

                    <?php
                      ini_set('display_errors', 'On');ini_set('display_errors', 1);
                      require_once "../modelo.php";
                      $db=new BaseDatos();

                      $result = $db->db->query("select * from tipo_empleado;");
                      $result = $result->fetch_all(MYSQLI_ASSOC);
                      foreach ($result as $a) {
                        echo "<option value='".$a['id']."'>".$a['nombre']."</option>";
                      } 
                    ?>

                  </select>
                </div>
                <div class="form-group" >
                  <form  action="" method="post" enctype="multipart/form-data">
                    <label class="control-label" id="userfile">Imágen de perfil</label>
                    <input id="formtipoempleado" type="file" class="filestyle" data-buttonname="btn-default">
                  </form>
                </div>

                  <div class="form-group text-right m-b-0">
                      <a class="cancelarempleado">
                        <button type="button" class="btn btn-default">Cancelar</button>
                      </a>
                      <a class="guardarempleado">
                        <button type="button" class="btn btn-success">Guardar</button>
                      </a>
                  </div>

              </form>
          </div>
				
					<div class="row">
							<div class="col-sm-12">
									<h4 class="header-title m-t-0">Dias de trabajo</h4>
							</div>
					</div> <!-- end row -->

					<div class="row">
							<div class="col-lg-12">

									<div class="m-t-10">
											<div class="row m-b-30">
													<div class="col-md-3">
															<div class="row">
																	<div class="col-md-12 col-sm-12 col-xs-12">
																			<a href="#" data-toggle="modal" data-target="#add-category" class="m-t-10 btn btn-lg btn-primary btn-block waves-effect m-t-20 waves-light">
																					<i class="fa fa-plus"></i> Crear un Evento
																			</a>
																			<div id="external-events" class="m-t-20">
																					<br>
																					<p class="text-muted">Arrastra y suelta los eventos diarios laborales y arma el horario</p>
																					<div class="external-event bg-success" data-class="bg-success">
																							<i class="mdi mdi-checkbox-blank-circle m-r-10 vertical-middle"></i>Trabajo de Cocina
																					</div>
																					<div class="external-event bg-info" data-class="bg-info">
																							<i class="mdi mdi-checkbox-blank-circle m-r-10 vertical-middle"></i>Meserio
																					</div>
																					<div class="external-event bg-primary" data-class="bg-primary">
																							<i class="mdi mdi-checkbox-blank-circle m-r-10 vertical-middle"></i>Turno doble
																					</div>
																					<div class="external-event bg-warning" data-class="bg-warning">
																							<i class="mdi mdi-checkbox-blank-circle m-r-10 vertical-middle"></i>Dia Libre
																					</div>
																			</div>

																			<!-- checkbox -->
																			<div class="checkbox checkbox-custom m-t-30">
																					<input id="drop-remove" type="checkbox">
																					<label for="drop-remove">
																							Evento Único
																					</label>
																			</div>

																	</div>
															</div>
													</div> <!-- end col-->
													<div class="col-md-9">
															<div id="calendar"></div>
													</div> <!-- end col -->
											</div>  <!-- end row -->
									</div>

									<!-- BEGIN MODAL -->
									<div class="modal fade none-border" id="event-modal">
											<div class="modal-dialog">
													<div class="modal-content">
															<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title">Añadir Evento</h4>
															</div>
															<div class="modal-body p-20"></div>
															<div class="modal-footer">
																	<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
																	<button type="button" class="btn btn-success save-event waves-effect waves-light">Crear Evento</button>
																	<button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Eliminar</button>
															</div>
													</div>
											</div>
									</div>

									<!-- Modal Add Category -->
									<div class="modal fade none-border" id="add-category">
											<div class="modal-dialog">
													<div class="modal-content">
															<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title">Añadir Nuevo</h4>
															</div>
															<div class="modal-body p-20">
																	<form role="form">
																			<div class="row">
																					<div class="col-md-6">
																							<label class="control-label">Nombre del Evento</label>
																							<input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
																					</div>
																					<div class="col-md-6">
																							<label class="control-label">Elige Tipo</label>
																							<select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
																									<option value="success">Cocina</option>
																									<option value="danger">Mesa</option>
																									<option value="info">Turno Doble</option>
																									<option value="primary">Evento Privado</option>
																									<option value="warning">Permiso</option>
																							</select>
																					</div>
																			</div>
																	</form>
															</div>
															<div class="modal-footer">
																	<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
																	<button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
															</div>
													</div>
											</div>
									</div>
									<!-- END MODAL -->
							</div>
							<!-- end col-12 -->
					</div> <!-- end row -->

      </div>
  </div>
</div>


<script>
$(document).ready(function() {
	$('select#selecttipoempleado').on('change',function(){
				selecttipoempleado = $(this).val();
				console.log("select tipo empleado"+selecttipoempleado);
	});
});
</script>



<script src="../assets/pages/jquery.fullcalendar.js"></script>
<script src="../assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script src="../assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="../assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="../assets/plugins/switchery/switchery.min.js"></script>
<script type="text/javascript" src="../assets/plugins/parsleyjs/parsley.min.js"></script>

<script src="../assets/plugins/moment/moment.js"></script>
<script src="../assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../assets/plugins/summernote/summernote.min.js"></script>
<!-- Sweet-Alert  -->
<script src="../assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="../assets/pages/jquery.sweet-alert.init.js"></script>


<!-- form advanced init js -->
<script src="../assets/pages/jquery.form-advanced.init.js"></script>

<!-- App Js -->
<script src="../assets/js/jquery.app.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.form-validation').parsley();
        $('.summernote').summernote({
            height: 350,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
    });
</script>