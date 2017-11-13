<?php
ini_set('display_errors', 'On');ini_set('display_errors', 1);
    include_once "../modelo.php";
    $db = new BaseDatos();
    $db->db->query("truncate table venta_temporal;");
?>