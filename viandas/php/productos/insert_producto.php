<?php
ini_set('display_errors', 'On');ini_set('display_errors', 1);
    include_once "../modelo.php";
    $db = new BaseDatos();

    $nombre = $_POST['nombre'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $existencia = $_POST['existencia'];
    $tipo = $_POST['tipo'];

    $idProveedor = $_POST['idProveedor'];

    $query = "insert into producto values(NULL, '$nombre', $precio_compra, $precio_venta, $existencia, $tipo);";
    $db->db->query($query);

    $result = $db->db->query("select max(id) as id from producto;");
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $id = $result[0]['id'];

    $query = "insert into proveedor_producto values ($idProveedor, $id);";
    $db->db->query($query);
?>