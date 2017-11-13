<div class="content">
  
<?php
  require_once "../modelo.php";
  ini_set('display_errors', 'On');ini_set('display_errors', 1);
  $db=new BaseDatos();
  
  $calificacion = $_POST['calificacion'];

  $result = $db->db->query("select max(id)+1 as idVenta from venta;");
  $result = $result->fetch_all(MYSQLI_ASSOC);
  $idVenta = $result[0]['idVenta'];

  $query = "select p.id as idProducto, p.precio_venta, p.precio_compra, v.cantidad as cantidad
    from venta_temporal as v inner join producto as p on p.id=v.idProducto ;";

  $result = $db->db->query($query);
  $result = $result->fetch_all(MYSQLI_ASSOC);
  
  $inversion = 0;
  $ganancia = 0;
  $nn = "insert into venta_producto values ";
  
  foreach ($result as $a){
    //valida que no se mande datos vacios
    if($a['cantidad']<1){
      continue;
    }
      
    $db->db->query("update producto set existencia = existencia - ".$a['cantidad']." where id = ".$a['idProducto'].";");
    
    $inversion += $a['precio_compra'];
    $ganancia += $a['precio_venta'];
    
    $nn .= "(".$a['idProducto'].", $idVenta, ".$a['cantidad']."),";
  }
  
  session_start();
  $idEmpleado = $_SESSION['USUARIO'];
  //valida que no se mande datos vacios
  if($inversion>0 && $ganancia>0){
    $query =  "insert into venta values(NULL, now(), $inversion, $ganancia, $ganancia-$inversion, $idEmpleado, $calificacion)";
    $db->db->query($query);
  }

  $nn = substr($nn, 0, -1);
  $nn .= ";";
  $db->db->query($nn);

  $db->db->query("truncate table venta_temporal;");
  
?>
</div>


