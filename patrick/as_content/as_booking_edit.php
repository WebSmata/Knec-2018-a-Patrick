<?php include AS_THEME."as_header.php";
	$myaccount = isset( $_SESSION['site_account'] ) ? $_SESSION['site_account'] : "";
	$database = new As_Dbconn();			

	$bookingid = $results['item'];
	$as_db_query = "SELECT * FROM as_booking WHERE bookingid = '$bookingid'";
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
	list( $bookingid, $booking_name,$booking_mobile, $booking_date, $booking_class, $booking_room, $booking_booking, $booking_amount, $booking_payment) = $database->get_row( $as_db_query );
}
		
	?>
  <div class="inner">
    <div class="main">
      <section id="content">        
        <div class="padding-2">
          <div class="indent-top">
            <div class="wrapper">
              <article class="col-3">
                <h4><strong>Edit</strong><em>A Ticket Now!!!</em></h4><hr>
				<form role="form" method="post" name="EditItem" action="index.php?page=booking_edit&&as_bookingid=<?php echo $bookingid ?>" enctype="multipart/form-data" >
                <table class="tab_booking">				
				<tr>
					<td>Customer Name:
					<input type="text" autocomplete="off" name="customer" value="<?php echo $booking_name ?>" required >
					</td>
					<td>Mobile Number:
						<input type="text" autocomplete="off" name="mobile" value="<?php echo $booking_mobile ?>" required />
					</td>
				</tr>
				 <tr>
					<td>Ticket Date:
					<input type="text" autocomplete="off" name="date" placeholder="DD-MM-YYYY" value="<?php echo $booking_date ?>" required >
					</td>
					<td>Ticket Type:
						<select name="type" style="padding-left:20px;" required >
						<option value="<?php echo $booking_class ?>" > - Ticket Type - </option>
						<option value="VIP" > VIP Class </option>
						<option value="Normal" > Normal </option>
					   </select>
					</td>
				</tr>
				<tr> 
					<td>Stand Type:
						<select name="stand" style="padding-left:20px;" required >
						<option value="<?php echo $booking_room ?>" > - Stand Type - </option>
						<option value="VIP" > VIP Class </option>
						<option value="Normal" > Normal </option>
					   </select>
					</td> 
					<td>Booking Type:
						<select name="booking" style="padding-left:20px;" required >
						<option value="<?php echo $booking_class ?>" > - Booking Type - </option>
						<option value="Advance" > Advance Booking </option>
						<option value="Normal" > Normal Booking </option>
					   </select>
					</td>
				</tr>
                <tr>
					<td>Amount Paid:
					<input type="text" autocomplete="off" name="amount" value="<?php echo $booking_amount ?>" required >
					</td>
					<td>Mode of Payment:
						<select name="payment" style="padding-left:20px;" required >
						<option  value="<?php echo $booking_payment ?>" > - Mode of payment - </option>
						<option value="Cash payment"> Cash payment </option>
						<option value="Mpesa/AirtelMoney"> Mpesa/AirtelMoney </option>
						<option value="Cheque"> Cheque </option>
						<option value="Visa Card"> Visa Card </option>
					   </select>
					</td>
				</tr>
								
				</table><br>
				<center>
				<input type="submit" class="submit_this" name="EditTicket" value="Save Changes">
				</center>
                <br></form>
              </article>
			  <?php include AS_THEME."as_sidebar.php" ?>
              
            </div>
          </div>
        </div>
	
      </section>
      <div class="block"></div>
    </div>
  </div>
</div>


<?php include AS_THEME."as_footer.php" ?>