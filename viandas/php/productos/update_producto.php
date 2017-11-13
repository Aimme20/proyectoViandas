<?php
ini_set('display_errors', 'On');ini_set('display_errors', 1);
    include_once "../modelo.php";
    $db = new BaseDatos();

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $existencia = $_POST['existencia'];
    $tipo = $_POST['tipo'];

    $query = "update producto set nombre = '$nombre', precio_compra = $precio_compra, precio_venta = $precio_venta,
      existencia = $existencia, tipo = $tipo where id = $id;";
    $db->db->query($query);
?>