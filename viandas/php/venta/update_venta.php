<?php
  require_once "../modelo.php";
  ini_set('display_errors', 'On');ini_set('display_errors', 1);
  $db=new BaseDatos();

  $producto = $_POST['producto'];
  $state = $_POST['state'];

  $result = $db->db->query("select v.id from venta_temporal as v inner join producto as p on p.id = v.idProducto where nombre = '$producto';");
  $result = $result->fetch_all(MYSQLI_ASSOC);
  $idVenta = $result[0]['id'];

  $result = $db->db->query("select idProducto from venta_temporal where id = $idVenta;");
  $result = $result->fetch_all(MYSQLI_ASSOC);
  $idProducto = $result[0]['idProducto'];
  
  if($state == "+"){
    $result = $db->db->query("select existencia from producto where id = $idProducto;");
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $existencia = $result[0]['existencia'];
    
    if($existencia > 0){
      $db->db->query("update producto set existencia = existencia - 1 where id = $idProducto;");
      $db->db->query("update venta_temporal set cantidad = cantidad + 1 where id = $idVenta;");
    }
  }
  else if($state == "-"){
    $result = $db->db->query("select cantidad from venta_temporal where id = $idVenta;");
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $cantidad = $result[0]['cantidad'];
    
    if($cantidad > 1){
      $db->db->query("update producto set existencia = existencia + 1 where id = $idProducto;");
      $db->db->query("update venta_temporal set cantidad = cantidad - 1 where id = $idVenta;");
    }
    else {
      $db->db->query("update producto set existencia = existencia + 1 where id = $idProducto;");
      $db->db->query("delete from venta_temporal where id = $idVenta;");
    }
  }
  $idVenta = -1;

?>