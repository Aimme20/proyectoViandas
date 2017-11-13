
<?php
ini_set('display_errors', 'On');ini_set('display_errors', 1);
  include_once "../modelo.php";
  $db = new BaseDatos();

  $nombre = $_POST['nombre'];
  $RFC = $_POST['RFC'];
  $idProveedor = $_POST['idProveedor'];

  $query = "select id from proveedor where RFC = '$RFC';" ;
  $result = $db->db->query($query);
  $result = $result->fetch_all(MYSQLI_ASSOC);

  if($result == null){
    if($idProveedor == 0)
      $query = "insert into proveedor values (NULL, '$nombre', '$RFC');";
    else
      $query = "update proveedor set nombre = '$nombre', RFC = '$RFC' where id = $idProveedor;";
    $db->db->query($query);
  }
  
?>