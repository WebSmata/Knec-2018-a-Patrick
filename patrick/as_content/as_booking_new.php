<?php include AS_THEME."as_header.php"; 
	$roomtype = $_GET['roomtype'];
	$datein = $_GET['datein'];
	$dateout = $_GET['dateout'];
	
	$database = new As_Dbconn();
	$room_qry = "SELECT * FROM as_room ORDER BY roomid ASC";
	$results = $database->get_results( $room_qry );
	
?>
<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Check in to a Room</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>				
			</div>
			<div class="row">
				<!-- contact form -->
				<div class="tm-contact-form">
					<div class="col-lg-3 col-md-3 tm-contact-form-input">
						<div class="contact-social">
							
						</div>
					</div>
					<div class="col-lg-6 col-md-6 tm-contact-form-input">
						<form action="index.php?page=checkin" method="post" >
							<div class="form-group">
								 <select class="form-control" name="booking_room" required>
									<option value="">-- Select Room -- </option>
									<?php foreach ($results as $row) { ?>
										<option value="<?php echo $row['roomid'] ?>">Room <?php echo $row['room_title'].' - ('.$row['room_cost'].')' ?></option>
									<?php } ?>
								</select> 
							</div>
							<div class="form-group">
								<label>Check In Date</label>
								<input type="text" autocomplete="off" name=" " value="<?php echo $datein ?>" class="form-control" readonly>
							</div>
							<div class="form-group">
								<label>Check Out Date</label>
								<input type="text" autocomplete="off" name="booking_checkout" value="<?php echo $dateout ?>" class="form-control" readonly>
							</div>
							<div class="form-group">
								<label>Amount to Pay</label>
								<input type="text" autocomplete="off" name="booking_amount" value="" class="form-control">
							</div>
							
							<div class="form-group">
								<label>Customer Name</label>
								<input type="text" autocomplete="off" name="customer_name" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Mobile Phone</label>
								<input type="text" autocomplete="off" name="customer_mobile" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Email Address</label>
								<input type="text" autocomplete="off" name="customer_email" class="form-control" required>
							</div>
							<input type="submit" class="tm-submit-btn" name="FinishCheckin" value="Finish Checking In" /><br><br>
							<input type="submit" class="tm-submit-btn" name="CancelCheckin" value="Cancel" />
						</form>
					</div>
					<div class="col-lg-3 col-md-3 tm-contact-form-input">
						<div class="contact-social">
							
						</div>
					</div>
			</div>			
		</div>
	</section>
<?php include AS_THEME."as_footer.php" ?>