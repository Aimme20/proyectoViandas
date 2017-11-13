<?php 
// Activar errores
  ini_set('display_errors', 'On');ini_set('display_errors', 1);
    include_once "../modelo.php";
    $db = new BaseDatos();//instanciamos la base de datos
    $mysqli= $db->getCon();
    if($db->conectar()){//si se conecta

      //Para la modificación, cuando es diferente a 0
      $id = $_POST['id'];
      echo "ECHOOO ID:  ".$id;
      //obtiene datos
      $nombre = $_POST['name'];
      $username = $_POST['username'];
      $apellido = $_POST['apellido'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirm = $_POST['confirm'];
      $idTipo = $_POST['idTipo'];
      $fil = $_FILES["userfile"]["tmp_name"];

      if($password!=$confirm)//caso de una contraseña mal escrita en la comfirmacion
        echo "<script>alert('La contraseña no coincide!');</script>";
      else{
        $repetido = $db->consulta("SELECT id FROM empleado WHERE email='$email'");
        $repetido = $repetido[0];
        if($repetido!=0){
          echo "<script>alert('El correo ya se ha registrado antes!');</script>";
          return;
        }

        // Los posible valores que puedes obtener de la imagen son:
        //echo "<BR>".$_FILES["userfile"]["name"];      //nombre del archivo
        //echo "<BR>".$_FILES["userfile"]["type"];      //tipo
        //echo "<BR>".$_FILES["userfile"]["tmp_name"];  //nombre del archivo de la imagen temporal
        //echo "<BR>".$_FILES["userfile"]["size"];      //tamaño
        # Comprovamos que se haya subido un fichero
        if (isset($_FILES["userfile"]["tmp_name"])){
            # verificamos el formato de la imagen
            if ($_FILES["userfile"]["type"]=="image/jpeg" || $_FILES["userfile"]["type"]=="image/pjpeg" ||
                $_FILES["userfile"]["type"]=="image/gif" || $_FILES["userfile"]["type"]=="image/bmp" ||
                $_FILES["userfile"]["type"]=="image/png"){
                # Cogemos la anchura y altura de la imagen
                $info=getimagesize($_FILES["userfile"]["tmp_name"]);

                //echo "<BR>".$info[0]; //anchura
                //echo "<BR>".$info[1]; //altura
                //echo "<BR>".$info[2]; //1-GIF, 2-JPG, 3-PNG
                //echo "<BR>".$info[3]; //cadena de texto para el tag <img

                # Escapa caracteres especiales
                $imagenEscapes=$mysqli->real_escape_string(file_get_contents($_FILES["userfile"]["tmp_name"]));
                 //creamos query
                if($id == 0)
                  $query = "INSERT INTO empleado values (NULL,'$nombre', '$apellido', '$email', '$username',  
                    '$password', '$imagenEscapes', 5000.00, $idTipo);";
                else 
                  $query = "update empleado set nombre = '$nombre', apellidos = '$apellido', correo = '$email', username = '$username',
                  password = '$password', foto = '$imagenEscapes', sueldo = 5001.11, tipo = $idTipo where id = $id";
              
                //ejecutamos
                $db->registrar($query);
            }
            //$this->result = $db->getInfo($query);
        }
        else{//no hay foto
          echo "<script>alert('Es importante que ingreses una foto de perfil!');</script>";
        }
      }
    }
echo "ALGO";

?>