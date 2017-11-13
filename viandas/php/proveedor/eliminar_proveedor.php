<?php
ini_set('display_errors', 'On');ini_set('display_errors', 1);
    include_once "../modelo.php";
    $db = new BaseDatos();
    $idProveedor = $_POST['idProveedor'];
    $query = "delete from proveedor where id = '$idProveedor';";
    $db->db->query($query);
?>