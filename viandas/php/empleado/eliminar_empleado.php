<?php
ini_set('display_errors', 'On');ini_set('display_errors', 1);
    include_once "../modelo.php";
    $db = new BaseDatos();
    $idEmpleado = $_POST['idEmpleado'];
    $query = "delete from empleado where id = '$idEmpleado';";
    $db->db->query($query);
?>