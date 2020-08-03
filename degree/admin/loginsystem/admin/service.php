<?php
session_start();
include'dbconnection.php';
// checking session is valid for not 
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

// for deleting user
if(isset($_GET['id']))
{
$adminid=$_GET['id'];
$msg=mysqli_query($con,"delete from users where id='$adminid'");
if($msg)
{
echo "<script>alert('Data deleted');</script>";
}
}
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Manage Users</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <section id="container" >
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <a href="#" class="logo"><b>Admin Dashboard</b></a>
            <div class="nav notify-row" id="top_menu">
               
                         
                   
                </ul>
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="#"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['login'];?></h5>
              	  	
                  <li class="mt">
                      <a href="change-password.php">
                          <i class="fa fa-file"></i>
                          <span>Change Password</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="manage-users.php" >
                          <i class="fa fa-users"></i>
                          <span>Manage Users</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">   <!--copy this-->
                      <a href="general.php" >
                          <i class="fa fa-users"></i>
                          <span>General</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">   <!--copy this-->
                      <a href="accidental.php" >
                          <i class="fa fa-users"></i>
                          <span>Accidental</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">   <!--copy this-->
                      <a href="service.php" >
                          <i class="fa fa-users"></i>
                          <span>Service</span>
                      </a>
                   
                  </li>
                  <li class="sub-menu">   <!--copy this-->
                      <a href="prediction.php" >
                          <i class="fa fa-users"></i>
                          <span>Prediction</span>
                      </a>
                   
                  </li>

                    <li class="sub-menu">   <!--copy this-->
                      <a href="pollution.php" >
                          <i class="fa fa-users"></i>
                          <span>Pollution</span>
                      </a>
                   
                  </li>
              
                 
              </ul>
          </div>
      </aside>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Service Details</h3>
				<div class="row">
				
                  
	                  
                  <div class="col-md-12" style="overflow-x:auto;">
                      <div class="content-panel" >
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> All Service Details </h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th class="hidden-phone">Type</th>
                                  <th> Brand</th>
                                  <th> Model</th>
                                  <th>Engine Type</th>
                                  <th>Year</th>
                                  <th>Region</th>
                                  <th>Mileage Range</th>
                                  <th>Range</th>
                                  <th>Oil Filter</th>
                                  <th>Engine oil</th><th>Washer Plug Drain</th>
                                  <th>Dust/Pollen Filter</th><th>Wheel Alignment</th>
                                  <th>Air Filter</th><th>Fuel Filter</th>
                                  <th>Spark Plug</th><th>Brake Fluid</th>
                                  <th>Brake&Clutch Oil</th><th>Transmission Fluid</th>
                                  <th>Brake Pad</th><th>Clutch</th>
                                  <th>Coolant</th><th>Cost</th>
                                  <th>Index</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $ret=mysqli_query($con,"select * from service_details");
							  $cnt=1;
							  while($row=mysqli_fetch_array($ret))
							  {?>
                              <tr>
                              <td><?php echo $cnt;?></td>
                              
                                  <td><?php echo $row['vehicle_type'];?></td>
                                  <td><?php echo $row['brand'];?></td>
                                  <td><?php echo $row['model'];?></td>  
                                  <td><?php echo $row['engine_type'];?></td>
                                  <td><?php echo $row['make_year'];?></td>
                                  <td><?php echo $row['region'];?></td>
                                  <td><?php echo $row['mileage_range'];?></td>
                                  <td><?php echo $row['mileage'];?></td>
                                  <td><?php echo $row['oil_filter'];?></td>
                                  <td><?php echo $row['engine_oil'];?></td>
                                  <td><?php echo $row['washer_plug_drain'];?></td>
                                  <td><?php echo $row['dust_and_pollen_filter'];?></td>
                                  <td><?php echo $row['whell_alignment_and_balancing'];?></td>
                                  <td><?php echo $row['air_clean_filter'];?></td>
                                  <td><?php echo $row['fuel_filter'];?></td>
                                  <td><?php echo $row['spark_plug'];?></td>
                                  <td><?php echo $row['brake_fluid'];?></td>
                                  <td><?php echo $row['brake_and_clutch_oil'];?></td>
                                  <td><?php echo $row['transmission_fluid'];?></td>
                                  <td><?php echo $row['brake_pads'];?></td>
                                  <td><?php echo $row['clutch'];?></td>
                                  <td><?php echo $row['coolant'];?></td>
                                  <td><?php echo $row['cost'];?></td>
                                  <td><?php echo $row['index_service'];?></td>
                                  
                                  
                                  
                              </tr>
                              <?php $cnt=$cnt+1; }?>
                             
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
		</section>
      </section
  ></section>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/common-scripts.js"></script>
  <script>
      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
<?php } ?>