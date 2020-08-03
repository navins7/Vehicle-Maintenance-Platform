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
                      <a href="general.php" >
                          <i class="fa fa-users"></i>
                          <span>Accidental</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">   <!--copy this-->
                      <a href="general.php" >
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
          	<h3><i class="fa fa-angle-right"></i> Car Physical Details</h3>
				<div class="row">
				
                  
	                  
                  <div class="col-md-12" style="overflow-x:auto;">
                      <div class="content-panel" >
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> All Details </h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th class="hidden-phone">Type</th>
                                  <th> Brand</th>
                                  <th> Model</th>
                                  <th>Engine Type</th>
                                  <th>Bonnet</th>
                                  <th>Door</th>
                                  <th>Front Bummper</th><th>Rear Bummper</th>
                                  <th>Front Headlight</th><th>Rear Headlight</th>
                                  <th>Side Mirror</th><th>Tail Light</th>
                                  <th>Clutch Plate</th><th>Brake Pad</th>
                                  <th>Front Windsheild</th><th>Rear Windsheild</th>
                                  <th>Ac Coil</th><th>Radiator</th>
                                  <th>Battery</th><th>Total</th>
                                  <th>Index</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $ret=mysqli_query($con,"select * from general_standard");
							  $cnt=1;
							  while($row=mysqli_fetch_array($ret))
							  {?>
                              <tr>
                              <td><?php echo $cnt;?></td>
                              
                                  <td><?php echo $row['vehicle_type'];?></td>
                                  <td><?php echo $row['brand'];?></td>
                                  <td><?php echo $row['model'];?></td>  
                                  <td><?php echo $row['engine_type'];?></td>
                                  <td><?php echo $row['bonnet'];?></td>
                                  <td><?php echo $row['door'];?></td>
                                  <td><?php echo $row['front_bumper'];?></td>
                                  <td><?php echo $row['rear_bumper'];?></td>
                                  <td><?php echo $row['front_headlight'];?></td>
                                  <td><?php echo $row['back_headlight'];?></td>
                                  <td><?php echo $row['side_mirror'];?></td>
                                  <td><?php echo $row['tail_light'];?></td>
                                  <td><?php echo $row['clutch_plate'];?></td>
                                  <td><?php echo $row['barke_pad'];?></td>
                                  <td><?php echo $row['front_windsheild'];?></td>
                                  <td><?php echo $row['rear_windsheild'];?></td>
                                  <td><?php echo $row['ac_evaporator_coil'];?></td>
                                  <td><?php echo $row['radiator'];?></td>
                                  <td><?php echo $row['battery'];?></td>
                                  <td><?php echo $row['total_acc'];?></td>
                                  <td><?php echo $row['index_acc'];?></td>
                                  
                                  
                                 
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