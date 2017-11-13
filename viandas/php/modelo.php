<?php

require_once "config.php";

class BaseDatos
{
    protected $conexion;
    public $db;

    public function __construct()
    {
        $this->db = new mysqli(HOST, USER, PASS, DBNAME);

        if ( $this->db->connect_errno )
        {
            echo "Fallo al conectar a MySQL: ". $this->db->connect_error;
            return;
        }

        $this->db->set_charset(DB_CHARSET);
    }

  //retorna la conexxion a la base de datos
  public function getCon(){
    return $this->db;
  }

//Conecta a la base de datos
    public function conectar()
    {
      //datos traidos del archivo config.php
        $this->conexion = mysqli_connect(HOST, USER, PASS, DBNAME);
        if ($this->conexion == null) DIE("Lo sentimos, no se ha podido conectar con MySQL: " . $this->$conexion->error);
        $this->db = mysqli_select_db($this->conexion, DBNAME);//selecciona bd
        if ($this->db == 0) DIE("Lo sentimos, no se ha podido conectar con la base datos: " . DBNAME);

        return true;
    }

//para cerrar la conexion de la db
    public function desconectar()
    {
      //se elimin la conexion
        if ($this->conectar->conexion) {
            mysqli_close($this->$conexion);
        }
    }

//manda un query insert, solo sirve para registrar
    public function registrar($commander)
    {
        $query = mysqli_query($this->conexion, $commander);
        if ($query == 0) echo "Sentencia incorrecta llamado a tabla:. ";
        else {
            //$nregistrostotal = $query->fetch_row();
            //echo "Hay $nregistrostotal[0] registros en la tabla: $tabla.";
            mysqli_free_result($query);
            return true;
        }
        return false;
    }

    public function getInfo($commander)
    {
        //comando sql a ejeutar
        $query = mysqli_query($this->conexion, $commander);//ejecucion del comando
        if ($query == null) echo "Sentencia incorrecta llamado";
        else {
            $est=array();
            //guarda los registros en un array
            while($reg = $query->fetch_row()){
              $est[]= $reg;
              //echo " $reg[1] registros en la tabla: $tabla.<br>";
            }
            //$nregistrostotal = $query->fetch_row();
            mysqli_free_result($query);//se libera el resultado
        }
        return $est;//retorna el array de registros
    }


//sirve para hacer consultas
    public function consulta($commander)
    {
        $query = mysqli_query($this->conexion, $commander);
        if ($query == null) echo "Sentencia incorrecta llamado a tabla:.";
        else {
            $nregistrostotal = $query->fetch_row();
            //echo "Hay $nregistrostotal[0] registros en la tabla: $tabla.";
            mysqli_free_result($query);
        }
        return $nregistrostotal;
    }

    public function login($user, $password)
    {
        #$commander = "SELECT tipo from usuarios where usuario='$user' AND contrasena=(select sha2('$password',0));"
        //echo $commander."<br>";
        $query = mysqli_query($this->conexion, $commander);
        if ($query == 0) echo "Sentencia incorrecta";
        else {
            $nregistrostotal = $query->fetch_row();
            //echo "Hay $nregistrostotal[0] registros en la tabla: $tabla.";
            mysqli_free_result($query);
        }
        return $nregistrostotal[0];
    }
}
?>
