<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Restaurant Las Viandas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- IMPORT CSS -->
				<?php
					session_start();
					if(!isset($_SESSION['USUARIO'])){
								header("location: login.php");
					}

					include_once("importCSS.php");	
				?>

    </head>


    <body>

        <div id="page-wrapper">
					<div id="head">
            <?php 
							//ini_set('display_errors', 'On');ini_set('display_errors', 1);
							include_once("head.php");
						?>
					</div>
						

            <!-- Page content start -->
            <div class="page-contentbar">
								<div class="menu">
                <?php
									include_once("menu.php");
								?>
								</div>

                <!-- START PAGE CONTENT -->
                <div id="page-right-content">
								
									<!-- CONTENIDO DINAMICO -->
									<div id="contenido">
										<?php
											include_once("home.php");
										?>
									</div>
									

										<!-- FOOTERS -->
                    <?php
											include_once("footer.php");
										?>

                </div>
                <!-- End #page-right-content -->

            </div>
            <!-- end .page-contentbar -->
        </div>
        <!-- End #page-wrapper -->

				<!-- IMPORT JS -->
				<?php
					include_once("importJS.php");
				?>

    </body>
</html>

