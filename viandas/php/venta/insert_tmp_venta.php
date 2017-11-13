<?php
  require_once "../modelo.php";
  ini_set('display_errors', 'On');ini_set('display_errors', 1);
  $idProducto = $_POST['idProducto'];
  $db=new BaseDatos();

  $query = "select * from venta_temporal where idProducto=$idProducto;";
  $result = $db->db->query($query);
  $result = $result->fetch_all(MYSQLI_ASSOC);

  $cantidad = count($result);
  if($cantidad>0){
    $query = "update venta_temporal set cantidad = cantidad + 1 where idProducto = $idProducto;"; 
  }
  else{
    $query = "insert into venta_temporal values(NULL, $idProducto, 1);";
  }
  $db->db->query($query);

?>