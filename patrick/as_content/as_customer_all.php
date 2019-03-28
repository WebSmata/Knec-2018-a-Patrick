<?php include AS_THEME."as_header.php";
	$database = new As_Dbconn();
	$myaccount = isset( $_SESSION['site_account'] ) ? $_SESSION['site_account'] : "";
	$as_db_query = "SELECT * FROM as_customer 
					LEFT JOIN as_booking ON as_customer.customerid = as_booking.booking_customer 
					LEFT JOIN as_room ON as_booking.booking_room = as_room.roomid
					ORDER BY as_customer.customerid ASC";
	$results = $database->get_results( $as_db_query );
?>
	<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h3><?php echo $database->as_num_rows( $as_db_query ) ?> Customers <a href="index.php?page=book_new"> + New Booking </a></h3></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>			
			</div>
			<div class="row">
				<div class="tm-contact-form">
					<div class="col-lg-1 col-md-1 col-md-1">
						<div class="contact-social">
						</div>
					</div>
					<div class="col-lg-10 col-md-10 col-md-10">
                <table class="tt_tb">
				<thead><tr class="tt_tr">
				  <th>Name</th>
				  <th>Mobile</th>
				  <th>Email</th>
				  <th>Room</th>
				</tr></thead>
				<tbody>
                <?php foreach( $results as $row ) { ?>
		        <tr>
					<td><?php echo $row['customer_name'] ?></td>
					<td><?php echo $row['customer_mobile'] ?></td>
					<td><?php echo $row['customer_email'] ?></td>
					<td><?php echo $row['room_title'] ?></td>
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