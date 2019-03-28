<?php include AS_THEME."as_header.php";
	$myaccount = isset( $_SESSION['site_account'] ) ? $_SESSION['site_account'] : "";
	$database = new As_Dbconn();			

	$roomid = $results['item'];
	$as_db_query = "SELECT * FROM as_room
			LEFT JOIN as_booking ON as_room.roomid = as_booking.booking_roomid
			WHERE roomid =$roomid ORDER BY as_room.roomid  ASC LIMIT 20";
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
	list( $roomid, $room_booked, $room_regno, $room_place, $room_colour, $room_class, $room_cost, $room_postedby, $room_posted, $room_updated, $room_updatedby, $bookingid, $booking_name, $booking_mobile) = $database->get_row( $as_db_query );
}	
?>
  <div class="inner">
    <div class="main">
      <section id="content">        
        <div class="padding-2">
          <div class="indent-top">
            <div class="wrapper">
              <article class="col-3">
                <h4><a href="index.php?page=room_all"><strong><- All Models</strong></a> | <em>Model <?php echo $room_regno ?></em></h4><hr>
				<center><img src="as_themes/images/slider-img2.jpg" style="margin-top:10px;width:100%" /></center>
				<table class="tt_tbr">
				  <tr>
				    <td>Model Floor:		<?php echo $room_colour ?></td>
				    <td>Model Size:		<?php echo $room_place ?></td>
				  </tr>
				  <tr>
				    <td>Model Class:		<?php echo $room_class ?></td>
				    <td>Model Cost:		Kshs. <?php echo $room_cost ?></td>
				  </tr>
				  <?php if (empty($booking_name)) { ?>
				  <tr>
				    <td>Vacant</td>
				    <td></td>
				  </tr>
				  <?php } else { ?>
				  <tr>
				    <td>Occupant:		<?php echo $booking_name ?></td>
				    <td>Mobile:		<?php echo $booking_mobile ?></td>
				  </tr>
				  <tr>
					<td><a href="index.php?page=room_checkout&&as_roomid=<?php echo $roomid ?>" onclick="return confirm('Are you sure you want to checkout this room from the system? \nBe roomeful, this action can not be reversed.')"> Check out this Model </a>
					</td><td></td>
				  </tr>
				  <?php } ?>
				</table>
				<br><hr>
				<center><h3><a href="index.php?page=room_edit&&as_roomid=<?php echo $roomid ?>">Edit this Model</a>
				 | <a href="index.php?page=room_delete&&as_roomid=<?php echo $roomid ?>" onclick="return confirm('Are you sure you want to delete this room from the system? \nBe roomeful, this action can not be reversed.')">Delete this Model</a></h3></center>
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