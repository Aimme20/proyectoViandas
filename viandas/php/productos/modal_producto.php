<link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
              require_once "../modelo.php";
              $db=new BaseDatos();

              if(isset($_POST['idProducto'])){
                $id = $_POST['idProducto'];
              }
              else 
                $id = 0;
              $a = $db->db->query("select * from producto where id = $id");
              $a = $a->fetch_all(MYSQLI_ASSOC);
              $a = $a[0];
              
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">EDITAR PRODUCTO<PRODUCTO></PRODUCTO></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="<?php echo $a['nombre'];?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-4" class="control-label">Precio de Compra</label>
                            <input type="text" class="form-control" id="precio_compra" placeholder="$" value="<?php echo $a['precio_compra'];?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Precio de Venta</label>
                            <input type="text" class="form-control" id="precio_venta" placeholder="$" value="<?php echo $a['precio_venta'];?>">
                        </div>
                    </div>
                </div>
              <div class="row">
                <div class="col-md-6">
                  <select class="form-control select2" id="tipo_productos">
                    <option>Tipo de Producto</option>

                    <?php
                      $tipos = $db->db->query("select id, nombre from tipo_producto");
                      $tipos = $tipos->fetch_all(MYSQLI_ASSOC);
                      foreach ($tipos as $b) {
                        echo "<option value='".$b['id']."'>".$b['nombre']."</option>";
                      } 
                      echo "</optgroup>";
                    ?>

                  </select>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-5" class="control-label">Existencia</label>
                        <input type="text" class="form-control" id="existencia" placeholder="$" value="<?php echo $a['existencia'];?>">
                    </div>
                </div>
              </div>
              
              <?php
                if($id == 0){
                  echo"
                  <div class='row'>
                    <div class='col-md-6'>
                      <select class='form-control select2' id='select_proveedor'>
                        <option>Proveedor</option>
                  ";
                          $prov = $db->db->query("select id, nombre from proveedor;");
                          $prov = $prov->fetch_all(MYSQLI_ASSOC);
                          foreach ($prov as $b) {
                            echo "<option value='".$b['id']."'>".$b['nombre']."</option>";
                          } 
                          echo "</optgroup>

                      </select>
                    </div>
                  </div>";
                }
              ?>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
              <a class="update_producto">
                <button type="button" class="btn btn-info waves-effect waves-light" data-dismiss="modal" data-backdrop="false">Guardar Cambios</button>
              </a>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<script src="../assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>

<!-- form advanced init js -->
<script src="../assets/pages/jquery.form-advanced.init.js"></script>
<!-- App Js -->
<script src="../assets/js/jquery.app.js"></script>
<script>
$(document).ready(function() {
		$('select#tipo_productos').on('change',function(){
				tipo_producto = $(this).val();
			console.log("tipo: "+tipo_producto);
		});
	});
	
	$(document).ready(function() {
		$('select#select_proveedor').on('change',function(){
				idProveedor_producto = $(this).val();
				console.log("prov seleccionado: "+idProveedor_producto);
			
		});
	});
</script>
<script>$('#con-close-modal').modal();</script>