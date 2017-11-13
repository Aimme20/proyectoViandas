<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
            <a href="index.html" class="logo">
                <img src="../assets/images/logo.png" alt="logo" class="logo-lg" />
                <img src="../assets/images/logo_sm.png" alt="logo" class="logo-sm hidden" />
            </a>
        </div>
    </div>

    <!-- Top navbar -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">

                <!-- Mobile menu button -->
                <div class="pull-left">
                    <button type="button" class="button-menu-mobile visible-xs visible-sm">
                        <i class="fa fa-bars"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>

                <!-- Top nav left menu -->
                <ul class="nav navbar-nav hidden-sm hidden-xs top-navbar-items">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>

                <!-- Top nav Right menu -->
                <ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
                    <li class="hidden-xs">
                        <form role="search" class="navbar-left app-search pull-left">
                             <input type="text" placeholder="Search..." class="form-control">
                             <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                  
                    <?php
                        include_once "modelo.php";
                        $db = new BaseDatos();

                        $query = "select count(*) as cant from producto where existencia <= 5";
                        $result = $db->db->query($query);
                        $result = $result->fetch_all(MYSQLI_ASSOC);
                        $cantidad = $result[0]['cant'];
                        
                        if($cantidad != null){
                  
                        echo "
                          <li class='dropdown top-menu-item-xs'>
                        <a href='#' data-target='#' class='dropdown-toggle menu-right-item' data-toggle='dropdown' aria-expanded='true'>
                            <i class='mdi mdi-bell'></i> <span class='label label-danger'>$cantidad</span>
                        </a>
                        <ul class='dropdown-menu p-0 dropdown-menu-lg'>
                            <!--<li class='notifi-title'><span class='label label-default pull-right'>New 3</span>Notification</li>-->
                            <li class='list-group notification-list' style='height: 267px;'>
                               <div class='slimscroll'>
                         ";
                                    $query = "select nombre, existencia from producto where existencia <= 5;";
                                    $result = $db->db->query($query);
                                    $result = $result->fetch_all(MYSQLI_ASSOC);
                                    
                                    foreach($result as $a){
                                      echo "
                                       <!-- list item-->
                                       <a href='javascript:void(0);' class='list-group-item'>
                                          <div class='media'>
                                             <div class='media-left p-r-10'>
                                                <em class='fa fa-bell-o bg-custom'></em>
                                             </div>
                                             <div class='media-body'>
                                                <h5 class='media-heading'>Alertas</h5>
                                                <p class='m-0'>
                                                    <small>Crisis!; <span class='text-primary font-600'>".$a['existencia']." ".$a['nombre']."</span>  en existencia, abastece!</small>
                                                </p>
                                             </div>
                                          </div>
                                       </a>
                                      ";
                                    }
                                  
                         echo "
                                     </div>
                                  </li>
                              </ul>
                          </li>
                              ";
                        }
                    ?>

                      
                    

                    <li class="dropdown top-menu-item-xs">
                        <a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true">
                          <?php
                          $id = $_SESSION['USUARIO'];
                           echo "<img src='profile_picture.php?id=$id' alt='user-img' class='img-circle'> ";
                          ?>
                          
                      </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="ti-user m-r-10"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings m-r-10"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-lock m-r-10"></i> Lock screen</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="ti-power-off m-r-10"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div> <!-- end container -->
    </div> <!-- end navbar -->
</div>
<!-- Top Bar End -->