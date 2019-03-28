<?php include AS_THEME."as_header.php";
	$database = new As_Dbconn();
	$myaccount = isset( $_SESSION['site_account'] ) ? $_SESSION['site_account'] : "";
	$as_db_query = "SELECT * FROM as_booking
					LEFT JOIN as_room ON as_booking.booking_room = as_room.roomid
					LEFT JOIN as_customer ON as_booking.booking_customer = as_customer.customerid
					ORDER BY as_booking.booking_room ASC";
	$results = $database->get_results( $as_db_query );
?>
	<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h3><?php echo $database->as_num_rows( $as_db_query ) ?> Tickets <a href="index.php?page=book_new"> + New Booking </a></h3></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>				
			</div>
			<div class="row">
				<!-- contact form -->
				<div class="tm-contact-form">
					<div class="col-lg-1 col-md-1 col-md-1">
						<div class="contact-social">
							
						</div>
					</div>
					<div class="col-lg-10 col-md-10 col-md-10">
                <table class="tt_tb">
				<thead><tr class="tt_tr">
				  <th>Customer</th>
				  <th>Room</th>
				  <th>Checkin</th>
				  <th>Checkout</th>
				  <th>Amount(Kshs)</th>
				  <th>Payment Mode</th>
				  <th>Actions</th>
				</tr></thead>
				<tbody>
                <?php foreach( $results as $row ) { ?>
		        <tr>
					<td><?php echo $row['customer_name'] ?></td>
					<td><?php echo $row['room_title'] ?></td>
					<td><?php echo $row['booking_checkin'] ?></td>
					<td><?php echo $row['booking_checkout'] ?></td>
					<td><?php echo $row['booking_amount'] ?></td>
					<td><?php echo $row['booking_payment'] ?></td>
					<td>
					<a href="index.php?page=booking_view&amp;as_bookingid=<?php echo $row['bookingid'] ?>">View</a> 
					</td>
		        </tr>
			
			<?php } ?>
			
                      </tbody>
                    </table>
					</div>
					<div class="col-lg-1 col-md-1 col-md-1">
						<div class="contact-social">
							
						</div>
					</div>
			</div>			
		</div>
	</section>
<?php include AS_THEME."as_footer.php" ?>