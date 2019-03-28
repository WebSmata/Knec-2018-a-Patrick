<?php include AS_THEME."as_header.php"; 
	
	$database = new As_Dbconn();
	$bookingid = $_GET['as_bookingid'];
	$as_db_query = "SELECT * FROM as_booking
				LEFT JOIN as_customer ON as_booking.booking_customer = as_customer.customerid
				WHERE bookingid=$bookingid";
		
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
		list( $bookingid, $booking_customer, $booking_name, $booking_checkin, $booking_checkout, $booking_room, $booking_itemid, $booking_amount, $booking_payment, $booking_postedby, $booking_posted, $booking_updated, $booking_updatedby, $customerid, $customer_name, $customer_mobile, $customer_email) = $database->get_row( $as_db_query );
	} 
	
?>
	<style>
		.receipt{ width: 100%; font-size: 15px;} 
		.receipt td{ padding: 10px;} 
	</style>
	<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Receipt - Booking Review</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>				
			</div>
			<div class="row">
				<!-- contact form -->
				<div class="tm-contact-form">
					<div class="col-lg-2 col-md-2 tm-contact-form-input">
						<div class="contact-social">
							
						</div>
					</div>
					<div class="col-lg-9 col-md-9 col-md-9 tm-contact-form-input">
					<center>
					<table class="receipt" border="5"><tr><td valign="top">
						<div class="form-group">
							<label><?php echo as_where1($booking_room) ?> Name</label>
							<input type="text" autocomplete="off" name="booking_name" value="<?php echo $booking_name ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Check In Date</label>
							<input type="text" autocomplete="off" name="booking_checkin" value="<?php echo $booking_checkin ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Check Out Date</label>
							<input type="text" autocomplete="off" name="booking_checkout" value="<?php echo $booking_checkout ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Amount Paid</label>
							<input type="text" autocomplete="off" name="booking_amount" value="<?php echo $booking_amount ?>" class="form-control" readonly>
						</div>
						</td><td valign="top">
						<div class="form-group">
							<label>Full Name</label>
							<input type="text" autocomplete="off" name="customer_name" value="<?php echo $customer_name ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Mobile Phone</label>
							<input type="text" autocomplete="off" name="customer_mobile" value="<?php echo $customer_mobile ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Email Address</label>
							<input type="text" autocomplete="off" name="customer_email" value="<?php echo $customer_email ?>" class="form-control" readonly>
						</div>
						</td></tr></table>
					</div>
					<div class="col-lg-2 col-md-2 tm-contact-form-input">
						<div class="contact-social">
							
						</div>
					</div><br><hr><br>
					<h2><center><a href="index.php?page=ticket_delete&&as_ticketid=<?php echo $bookingid ?>" onclick="return confirm('Are you sure you want to cancel this ticket from the system? \nBe careful, this action can not be reversed.')">Cancel this Ticket?</a> | <a href="index.php?page=booking_all">View all Receipts</a></center></h2>
			</div>			
		</div>
	</section>


<?php include AS_THEME."as_footer.php" ?>