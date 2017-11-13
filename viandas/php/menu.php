<!--left navigation start-->
<aside class="sidebar-navigation">
    <div class="scrollbar-wrapper">
        <div>
            <button type="button" class="button-menu-mobile btn-mobile-view visible-xs visible-sm">
                <i class="mdi mdi-close"></i>
            </button>
            <!-- User Detail box -->
            <div class="user-details">
                <div class="pull-left">
										<?php
											$id = $_SESSION['USUARIO'];
											echo "<img src='profile_picture.php?id=$id' class='thumb-md img-circle'>";
										?>
                </div>
                <div class="user-info">
										<?php
											$query = "select concat(e.nombre, ' ', e.apellidos) as nombre, p.nombre as tipo from empleado as e 
											inner join tipo_empleado as p on p.id=tipo where e.id = $id;";
											$result = $db->db->query($query);
          						$result = $result->fetch_all(MYSQLI_ASSOC);
											$data = $result[0];
										?>
                    <a href="#"><?php echo $data['nombre'];?></a>
                    <p class="text-muted m-0"><?php echo $data['tipo'];?></p>
                </div>
            </div>
            <!--- End User Detail box -->

            <!-- Left Menu Start -->
            <ul class="metisMenu nav" id="side-menu">
              	<?php
									include_once "modelo.php";
									$db = new BaseDatos();
								?>
                <li class="home"><a href="#"><i class="ti-home"></i> INICIO </a></li>
              
                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-share"></i> VENTAS <span class="fa arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true" id="ventas">
                        <li class="vender"><a href="#">VENDER</a></li>
                        <li class="historial"><a href="#">HISTORIAL DE VENTAS</a></li>
                    </ul>
                </li>
              
                <li class="inventarios"><a href="#"><i class="ti-pencil-alt"></i> INVENTARIOS </a></li>
              	<?php
									$result = $db->db->query("select count(*) as cant from proveedor;");
									$result = $result->fetch_all(MYSQLI_ASSOC);
									$prov = $result[0]['cant'];
								?>
                <li class="proveedores"><a href="#"><span class="label label-custom pull-right"><?php echo $prov;?></span> <i class="ti-pie-chart"></i> PROVEEDORES </a></li>
								<?php
									$result = $db->db->query("select count(*) as cant from producto;");
									$result = $result->fetch_all(MYSQLI_ASSOC);
									$prov = $result[0]['cant'];
								?>
								<li class="productos"><a href="#"><span class="label label-custom pull-right"><?php echo $prov;?></span> <i class="ti-paint-bucket"></i> PRODUCTOS </a></li>
								<?php
									$result = $db->db->query("select count(*) as cant from empleado;");
									$result = $result->fetch_all(MYSQLI_ASSOC);
									$emp = $result[0]['cant'];
								?>
								<li class="empleados"><a href="#"><span class="label label-custom pull-right"><?php echo $emp;?></span> <i class="ti-menu-alt"></i> EMPLEADOS </a></li>
              
            </ul>
        </div>
    </div><!--Scrollbar wrapper-->
</aside>
<!--left navigation end-->
<!-- IMPORT JS -->
<?php
	include_once("importJS.php");
?>


<script type="text/javascript">  
  function ajax(page){
    $.ajax({  
      url: page,  
      success: function(data) {  
          $('#contenido').html(data);  
      }  
    });
  }
  
  $(document).ready(function(){

    $("#side-menu").on("click", ".home", function(event){
      ajax("home.php");
    });
    $("#side-menu").on("click", ".vender", function(event){
      ajax("venta.php");
    });
    $("#side-menu").on("click", ".empleados", function(event){
      ajax("empleados.php");
    });
		$("#side-menu").on("click", ".proveedores", function(event){
      ajax("proveedores.php");
    });
		$("#side-menu").on("click", ".productos", function(event){
      ajax("productos.php");
    });
		$("#side-menu").on("click", ".inventarios", function(event){
      ajax("inventarios.php");
    });
		$("#side-menu").on("click", ".historial", function(event){
      ajax("venta/historial_venta.php");
    });

  });  
</script>  

  <!-- script mamalon para la busqueda -->
<script>
  // concretar venta
  $(document).on('click', 'a.botonpedorro', function (event) {
		var url = "venta/modal_venta.php";  

		$.ajax({
      type: "POST",
      url: url,
      data: {"dumy":"dumy"},
      success: function(data) {
				$('#modal_venta').html(data);
      }

    });

  });
	
	$(document).on('click', 'a.vender', function (event) {
		var calificacion = $("#range_01").val();
		console.log("calificacion: "+calificacion);
    var url = "venta/concretar_venta.php";  
    $.ajax({
      type: "POST",
      url: url,
      data: {"calificacion":calificacion},
      success: function() {
					swal("Genial!", "Has concretado una venta!", "success");
				
          $('#tabla').load("venta/tabla.php");
          $('#head').load("head.php");
      }

    });
  });

  $(document).on('click', 'a.mas', function (event) {
    var id = $(this).parents("tr").find("td").eq(0).html();
    console.log(id);
    var url = "venta/update_venta.php";  
    $.ajax({
      type: "POST",
      url: url,
      data: {"producto":id, "state":"+"},
      success: function() {
        console.log("success");
        $('#tabla').load("venta/tabla.php");
        $('#head').load("head.php");
      }

    });
  });
  
  $(document).on('click', 'a.menos', function (event) {
    var id = $(this).parents("tr").find("td").eq(0).html();
    console.log(id);
    var url = "venta/update_venta.php";  
    $.ajax({
      type: "POST",
      url: url,
      data: {"producto":id, "state":"-"},
      success: function() {
        console.log("success");
        $('#tabla').load("venta/tabla.php");
        $('#head').load("head.php");
      }

    });
  });


</script>
  

<script>
  $(document).on('click', 'a.switchtabla', function (event) {
    
    var state;
    
    if ($("#switchvistatabla").is(":checked")) {  
        state = 1;
    } else {
        state = 0;
    }
    console.log("switch: "+state);
		
    var url = "venta/historial_venta.php";  
    $.ajax({
      type: "POST",
      url: url,
      data: {"state":state},
      success: function(data) {
          $('#contenido').html(data);
      }

    });
  });

</script>

<script>
	// variable superglobal para controlar el modificar empleados o agregar nuevos 
	//(0 es nuevo,  diferente es el id del empleado)
	var idEmpleado = 0;
	// eliminar y modificar usuario
$(document).on('click', 'a.borrarempleado', function (event) {
  var valor = $(this).attr("id")
	console.log("valor: "+valor);
	$.ajax({
			type: "POST",
			url: "empleado/eliminar_empleado.php",
			data: {"idEmpleado":valor},
			success: function(data) {
				$("#menu").load("menu.php");
				$("#contenido").load("empleados.php");
				swal("Has eliminado un empleado!");
			}

		}); 
});
	
$(document).on('click', 'a.editarempleado', function (event) {
  var valor = $(this).attr("id")
	idEmpleado = valor;
	console.log("id: "+idEmpleado);
	
	$.ajax({
			type: "POST",
			url: "empleado/nuevo_empleado.php",
			data: {"idEmpleado":valor},
			success: function(data) {
				$('#contenido').html(data);  
			}

		}); 
});

var selecttipoempleado = 1;

	
$(document).on('click', 'a.guardarempleado', function (event) {
    
    var name = $("#name").val();
    var apellido = $("#apellido").val();
    var username = $("#username").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var confirm = $("#confirm").val();
    var idTipo = selecttipoempleado;
    var inputFileImage = document.getElementById('formtipoempleado');
    var file = inputFileImage.files[0];
  
    var data = new FormData();

    data.append("userfile",file);
    data.append("name",name);
    data.append("apellido",apellido);
    data.append("username",username);
    data.append("email",email);
    data.append("password",password);
    data.append("confirm",confirm);
    data.append("idTipo",idTipo);
		data.append("id",idEmpleado);
  
    console.log("DATOS: "+name+" "+apellido+" "+username+" "+email+" "+password+" "+confirm+" Tipo: "+idTipo+" "+file+" idEmpleado: "+idEmpleado);
    var url = "empleado/insert_empleado.php";  
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      contentType:false,
      processData:false,
      cache:false,
      success: function(data) {
        console.log(data);
        console.log("sucess empleado");
        $('#contenido').load("empleados.php");
				$("#menu").load("menu.php");
				swal("Genial!", "Ahora "+name+" trabaja con nosotros!", "success");
      }

    });
  });
</script>

<script>
var idProveedor = 0;
	
$(document).on('click', 'a.borrarproveedor', function (event) {
  var valor = $(this).attr("id")
	console.log("valor: "+valor);
	$.ajax({
			type: "POST",
			url: "proveedor/eliminar_proveedor.php",
			data: {"idProveedor":valor},
			success: function(data) {
				console.log(data);
				$('#contenido').load("proveedores.php");
				$("#menu").load("menu.php");
				swal("Has borrado un proveedor.");
			}
		}); 
});
	
$(document).on('click', 'a.editarproveedor', function (event) {
  var valor = $(this).attr("id");
	idProveedor = valor;
	console.log("idProveedor: "+idProveedor);
	$.ajax({
			type: "POST",
			url: "proveedor/nuevo_proveedor.php",
			data: {"idProveedor":valor},
			success: function(data) {
				$('#contenido').html(data);
				swal("Has editado la información de un proveedor!");
			}
		}); 
});
	
$(document).on('click', 'a.guardarproveedor', function (event) {
	var nombre = $("#nombre").val();
  var RFC = $("#RFC").val();
	console.log(nombre+" "+RFC);
	$.ajax({
      type: "POST",
      url: "proveedor/insert_proveedor.php",
      data: {"nombre":nombre, "RFC":RFC, "idProveedor":idProveedor},
      success: function(data) {
        console.log(data);
				$('#contenido').load("proveedores.php");
				$("#menu").load("menu.php");
				swal("Genial!", "Ahora "+nombre+" es nuestro proveedor!", "success");
      }

    });
});
</script>

<script>
	//abrir el modal de productos
	var idProducto = 0;
	var idProveedor_producto = 1;
	$(document).on('click', 'a.mas_productos', function (event) {
    var id = $(this).parents("tr").find("td").eq(0).html();
    console.log(id);
		idProducto = id;
    var url = "productos/modal_producto.php";  

		$.ajax({
      type: "POST",
      url: url,
      data: {"idProducto":id},
      success: function(data) {
				$('#modal').html(data);
      }

    });
  });
	
	$(document).on('click', 'a.nuevo_producto', function (event) {
		console.log("nuevo producto");
		idProducto = 0;
		var url = "productos/modal_producto.php";  

		$.ajax({
      type: "POST",
      url: url,
      data: {"dumy":"dumy"},
      success: function(data) {
				$('#modal').html(data);
      }

    });
  });
	
	var tipo_producto = 1;
	//abrir el modal de productos
	$(document).on('click', 'a.update_producto', function (event) {
		
		var id = idProducto
		var id_proveedor = idProveedor_producto;
		var nombre = $("#nombre").val();
		var precio_compra = $("#precio_compra").val();
		var precio_venta = $("#precio_venta").val();
		var existencia = $("#existencia").val();
		var tipo = tipo_producto;
		
		console.log("Data: "+id+" "+nombre+" prov: "+id_proveedor+" Tipo: "+tipo);
		
		var url;
		if(id != 0){
			url = "productos/update_producto.php";  
		}
		else{
			url = "productos/insert_producto.php";  
		}
		
		$.ajax({
      type: "POST",
      url: url,
      data: {"id":id, "nombre":nombre, "precio_compra":precio_compra, "precio_venta":precio_venta, 
						 "existencia":existencia, "tipo":tipo, "idProveedor":id_proveedor},
      success: function(data) {
				console.log(data);
				$("#contenido").load("productos.php");
				$("#menu").load("menu.php");
				swal("Genial!", "Has actualizado la lista de productos!", "success");
      }

    });
  });
	
	
</script>

