<?php include AS_THEME."as_header.php"; 
	$database = new As_Dbconn();
	$room_qry = "SELECT * FROM as_room ORDER BY roomid  ASC LIMIT 5";
	$hresults = $database->get_results( $room_qry );
	
	$customer_qry = "SELECT * FROM as_customer ORDER BY customerid  ASC LIMIT 5";
	$tresults = $database->get_results( $customer_qry );
	
	$booking_qry = "SELECT * FROM as_booking ORDER BY bookingid  ASC LIMIT 5";
	$bresults = $database->get_results( $booking_qry );
	
?>
	<!-- gray bg -->	
	<section class="container tm-home-section-1" id="more">
		<div class="section-margin-top">
			<div class="row">				
				<div class="tm-section-header">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Site Administration</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2">						
						<img src="as_themes/img/index-03.jpg" alt="image" class="img-responsive">
						<div class="tm-home-box-2-container">
							<a href="index.php?page=room_all" class="tm-home-box-2-link" title="View All Rooms"><span class="tm-home-box-2-description">Rooms</span></a>
							<a href="index.php?page=room_new" class="tm-home-box-2-link" title="Add New Room"><i class="fa fa-edit tm-home-box-2-icon border-left"></i> New</a>
						</div><hr style="margin-top:0px;">
						<ul style="margin-left:20px;">
						<?php foreach ($hresults as $hrow) { ?>
							<li><?php echo $hrow['room_title'] ?></li>
						<?php } ?>
					</div>
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2">						
					    <img src="as_themes/img/index-05.jpg" alt="image" class="img-responsive">
						<div class="tm-home-box-2-container">
							<a href="index.php?page=customer_all" class="tm-home-box-2-link" title="View All Customers"><span class="tm-home-box-2-description">Customers</span></a>
							<a href="index.php" class="tm-home-box-2-link" title="Start New Booking"><i class="fa fa-edit tm-home-box-2-icon border-left"></i>New</a>
						</div><hr style="margin-top:0px;">
						<ul style="margin-left:20px;">
						<?php foreach ($tresults as $trow) { ?>
							<li><?php echo $trow['customer_name'].', '.$trow['customer_mobile'] ?></li>
						<?php } ?>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2 tm-home-box-2-right">						
					    <img src="as_themes/img/index-06.jpg" alt="image" class="img-responsive">
						<div class="tm-home-box-2-container">
							<a href="index.php?page=booking_all" class="tm-home-box-2-link" title="View all Bookings"><span class="tm-home-box-2-description">Bookings</span></a>
							<a href="index.php" class="tm-home-box-2-link" title="Start New Booking"><i class="fa fa-edit tm-home-box-2-icon border-left"></i>New</a>
						</div><hr style="margin-top:0px;">
						<ul style="margin-left:20px;">
						<?php foreach ($bresults as $brow) { ?>
							<li><?php echo as_where1($brow['booking_room']) ?> Booking, <?php echo $brow['booking_checkin'] ?></li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>		
		</div>
	</section>		
	
<?php include AS_THEME."as_footer.php" ?>