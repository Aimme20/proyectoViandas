<div class="container">
  <?php
	//ini_set('display_errors', 'On');ini_set('display_errors', 1);
    include_once "modelo.php";
    $db = new BaseDatos();
  ?>
  
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box widget-inline">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <?php
							session_start();
                $idUsuario = $_SESSION['USUARIO'];
                $query = "select sum(vp.cantidad) as cantidad from venta as v
                        inner join venta_producto as vp on vp.idVenta = v.id
                        where v.empleado = $idUsuario;";
                $result = $db->db->query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $misVentas = $result[0]['cantidad'];
								if($misVentas == null) $misVentas = 0;
                echo "
                <h3 class='m-t-10'><i class='text-primary mdi mdi-access-point-network'></i> <b data-plugin='counterup'>".$misVentas."</b></h3>
                ";
              ?>
                <p class="text-muted"><Mis></Mis>Mis Ventas Realizadas</p>
              
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
							<?php
                $query = "select count(*) as ventas_totales from venta;";
                $result = $db->db->query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $ventas_totales = $result[0]['ventas_totales'];
								if($ventas_totales == null) $ventas_totales = 0;
                echo "
                	<h3 class='m-t-10'><i class='text-custom mdi mdi-airplay'></i> <b data-plugin='counterup'>".$ventas_totales."</b></h3>
                ";
              ?>
              <p class="text-muted">Ventas del Negocio</p>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
							<?php
                $query = "select count(*) as cant_emp from empleado;";
                $result = $db->db->query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $total_empleados = $result[0]['cant_emp'];
                echo "
                	<h3 class='m-t-10'><i class='text-info mdi mdi-black-mesa'></i> <b data-plugin='counterup'>".$total_empleados."</b></h3>
                ";
              ?>
              <p class="text-muted">Total de Empleados</p>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center b-0">
							<?php
                $query = "select sum(existencia) as cantidades from producto;";
                $result = $db->db->query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $cantidades = $result[0]['cantidades'];
                echo "
                	<h3 class='m-t-10'><i class='text-danger mdi mdi-cellphone-link'></i> <b data-plugin='counterup'>".$cantidades."</b></h3>
                ";
              ?>
              
              <p class="text-muted">Productos Adquiridos</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
              <!--end row -->


  <div class="row">
		
      <div class="col-lg-6">
          <div class="card-box">
              <h4 class="m-t-0">Total Revenue</h4>
              <div class="text-center">
                  <ul class="list-inline chart-detail-list">
                      <li>
                          <h5 class="font-normal"><i class="fa fa-circle m-r-10 text-primary"></i>Series A</h5>
                      </li>
                      <li>
                          <h5 class="font-normal"><i class="fa fa-circle m-r-10 text-muted"></i>Series B</h5>
                      </li>
                  </ul>
              </div>
              <div id="dashboard-bar-stacked" style="height: 300px;"></div>
          </div>
      </div> <!-- end col -->

      <div class="col-lg-6">
          <div class="card-box">
              <h4 class="m-t-0">Sales Analytics</h4>
              <div class="text-center">
                  <ul class="list-inline chart-detail-list">
                      <li>
                          <h5 class="font-normal"><i class="fa fa-circle m-r-10 text-primary"></i>Mobiles</h5>
                      </li>
                      <li>
                          <h5 class="font-normal"><i class="fa fa-circle m-r-10 text-info"></i>Tablets</h5>
                      </li>
                  </ul>
              </div>
              <div id="dashboard-line-chart" style="height: 300px;"></div>
          </div>
      </div> <!-- end col -->
  </div> <!-- end row -->


  <div class="row">
      <div class="col-sm-12">
          <div class="card-box">
              <h4 class="m-t-0">Empleados</h4>
              <div class="table-responsive">
                  <table class="table table-hover mails m-0 table table-actions-bar">
                      <thead>
                          <tr>
                              <th>Imágen del Guapote</th>
                              <th>Nombre</th>
                              <th>Email</th>
                              <th>Productos Vendidos</th>
                              <th>Ultima Venta</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "select e.id, concat(e.nombre, ' ', e.apellidos) as nombre, e.correo, v.fecha 
                        from empleado as e left join venta as v on v.empleado = e.id order by v.fecha desc;";
                        $result = $db->db->query($query);
                        $result = $result->fetch_all(MYSQLI_ASSOC);
                        
                        $idActual = "nadabye";
                        foreach($result as $a){
                          if($a['id'] != $idActual)
                            $idActual = $a['id'];
                          else
                            continue;
                          
                        $vendidos = $db->db->query("select sum(vp.cantidad) as productos_vendidos from venta as v
                        inner join venta_producto as vp on vp.idVenta = v.id
                        where v.empleado = $idActual;");
                        $vendidos = $vendidos->fetch_all(MYSQLI_ASSOC);
                        $vendidos = $vendidos[0]['productos_vendidos'];
                        if($vendidos == null) $vendidos = 0;
                          
                          echo "<tr>
                                <td>
                                    <img src='profile_picture.php?id=".$a['id']."' alt='contact-img' title='contact-img' class='img-circle thumb-sm' />
                                </td>

                                <td>
                                    ".$a['nombre']."
                                </td>

                                <td>
                                    <a href='mailto:".$a['correo']."' class='text-muted'>".$a['correo']."</a>
                                </td>

                                <td>
                                    <b><a href='' class='text-dark'><b>".$vendidos."</b></a> </b>
                                </td>

                                <td>
                                    ".$a['fecha']."
                                </td>

                            </tr>";
                          }
                      ?>
                       </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>


</div>

<!-- Dashboard init -->
<script src="../assets/pages/jquery.dashboard.js"></script>
<script src="../assets/pages/jquery.morris.init.js"></script>