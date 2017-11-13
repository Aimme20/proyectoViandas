<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/viandas.ico">

          <!-- IMPORT CSS -->
				<?php
					include_once("importCSS.php");	
				?>


    </head>


    <body>
 <?php 
    // Activar errores
      //ini_set('display_errors', 'On');ini_set('display_errors', 1);
      session_start();
      if(isset($_SESSION['USUARIO'])){
            header("location: layout.php");
      }

      if( isset($_POST['user']) && isset($_POST['password']) ){
        
        include_once "modelo.php";
        $db = new BaseDatos();
          
          //obtiene datos
          $user = $_POST['user'];
          $password = $_POST['password'];
        
          $query = "select id from empleado where username = '$user' and password = '$password';" ;
          $result = $db->db->query($query);
          $result = $result->fetch_all(MYSQLI_ASSOC);
          $usuario = $result[0]['id'];
          if($usuario != 0){
            $_SESSION['USUARIO']=$usuario;
            header("location: layout.php");
          }
          else{
            echo "
              <div class='row'>
                <div class='col-sm-4 m-t-20'>
                 <div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert'
                            aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Oh Cagazón!</strong> La contraseña es incorrecta o el usuario no existe.
                    again.
                </div>
              </div>
            </div>
            ";
          }
      }
    ?>
        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h2 class="text-uppercase m-t-0 m-b-30">
                                        <a href="index.html" class="text-success">
                                            <span><img src="../assets/images/logo.png" alt="" height="30"></span>
                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" action="login.php" method="post">

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="usuario">USUARIO</label>
                                                <input class="form-control" type="user" id="user" required="" name="user" placeholder="super">
                                            </div>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <a href="#" class="text-muted pull-right font-14">Olvido su contraseña?</a>
                                                <label for="password">Contraseña</label>
                                                <input class="form-control" type="password" required="" id="password" name="password" placeholder="Agrege su contraseña (admin)">
                                            </div>
                                        </div>

                                        <div class="form-group m-b-30">
                                            <div class="col-xs-12">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="checkbox5" type="checkbox">
                                                    <label for="checkbox5">
                                                        Manterner la sessión abierta
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->


                            <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">No cuenta con un usuario registrado? <a href="pages-register.html" class="text-dark m-l-5">Entrar</a></p>
                                </div>
                            </div>

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->
      
     



	<!-- IMPORT JS -->
				<?php
					include_once("importJS.php");
				?>
    </body>
</html>