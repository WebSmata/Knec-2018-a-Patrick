<?php
	$myaccount 		= isset( $_SESSION['whiterhino_userid'] ) ? $_SESSION['whiterhino_userid'] : "";
	$sitename 		= as_get_option('as_sitename');
	$description 	= as_get_option('as_description');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $sitename ?></title>
  <link href="as_themes/css/font-awesome.min.css" rel="stylesheet">
  <link href="as_themes/css/bootstrap.min.css" rel="stylesheet">
  <link href="as_themes/css/bootstrap-datetimepicker.min.css" rel="stylesheet">  
  <link href="as_themes/css/flexslider.css" rel="stylesheet">
  <link href="as_themes/css/templatemo-style.css" rel="stylesheet">
  </head>
  <body class="tm-gray-bg">
  	<!-- Header -->
  	<div class="tm-header">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-6 col-md-4 col-sm-3 tm-site-name-container">
  					<a href="index.php" class="tm-site-name">White Rhino</a>	
  				</div>
	  			<div class="col-lg-6 col-md-8 col-sm-9">
	  				<div class="mobile-menu-icon">
		              <i class="fa fa-bars"></i>
		            </div>
	  				<nav class="tm-nav">
						<ul>
							<li><a href="index.php" class="active">Home</a></li>
							<?php if ($myaccount) { ?>
							<li><a href="index.php?page=administrator">Admin</a></li>
							<li><a href="index.php?page=logout">Logout</a></li>
							<?php } else { ?>
							<li><a href="index.php?page=login">Login</a></li>
							<?php } ?>
						</ul>
					</nav>		
	  			</div>				
  			</div>
  		</div>	  	
  	</div>
	
