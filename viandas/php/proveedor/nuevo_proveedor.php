


<?php
ini_set('display_errors', 'On');ini_set('display_errors', 1);
  $idProveedor = 0;
  if(isset($_POST['idProveedor'])){
    $idProveedor = $_POST['idProveedor'];
    include_once "../modelo.php";
    $db = new BaseDatos();
          
    $query = "select * from proveedor where id = $idProveedor;";
    $result = $db->db->query($query);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $a = $result[0];
  }
?>



<div class="content">
  <div class="col-lg-1"></div>

  <div class="col-lg-10">
      <div class="p-20 m-b-20">

          <h4 class="header-title m-t-0">Registro de Proveedores</h4>
          <p class="text-muted font-13 m-b-10">
              Aquí puedes registrar nuevos proveedores que abastecerán tu negocio.
          </p>

          <div class="p-20 m-b-20">
      
              <form action="#" class="form-validation">
                
                  <div class="form-group">
                      <label class="col-md-2 control-label">Nombre</label>
                          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" 
                                 <?php
                                    if($idProveedor!=0) echo "value='".$a['nombre']."' ";
                                 ?></input>
                  </div>
                  <div class="form-group">
                      <label class="col-md-2 control-label">RFC</label>
                          <input type="text" name="RFC" id="RFC" class="form-control" placeholder="RFC"
                                 <?php
                                    if($idProveedor!=0) echo "value='".$a['RFC']."' ";
                                 ?>>
                  </div>

                  <div class="form-group text-right m-b-0">
                      <a class="cancelarproveedor">
                        <button type="button" class="btn btn-default">Cancelar</button>
                      </a>
                      <a class="guardarproveedor">
                        <button type="button" class="btn btn-success">Guardar</button>
                      </a>
                  </div>

              </form>
          </div>

      </div>
  </div>
</div>






<!-- form advanced init js -->
<script src="../assets/pages/jquery.form-advanced.init.js"></script>

<!-- App Js -->
<script src="../assets/js/jquery.app.js"></script>
