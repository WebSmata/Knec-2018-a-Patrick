<?php include AS_THEME."as_header.php";
	$myaccount = isset( $_SESSION['site_account'] ) ? $_SESSION['site_account'] : "";
	$database = new As_Dbconn();			

	$roomid = $results['pageItem'];
	$as_db_query = "SELECT * FROM as_room WHERE roomid=$roomid";
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
	list( $roomid, $room_title, $room_type, $room_content, $room_image, $room_cost) = $database->get_row( $as_db_query );
}
?>
<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-4 col-md-6 col-sm-6"><h2 class="tm-section-title">Edit Room</h2></div>
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>	
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
						<form action="index.php?page=room_edit&amp;as_roomid=<?php echo $roomid ?>" method="post" enctype="multipart/form-data" >
							<input type="hidden" name="room_imaged" value="<?php echo $room_image ?>">
							<div class="form-group">
								<label>Room Type</label>
								 <select class="form-control" name="room_type" required>
									<option value="<?php echo $room_type ?>"> Select Room </option>
									<?php echo as_select_form($room_type, 'Single Room', 'single') ?>
									<?php echo as_select_form($room_type, 'Double Room', 'double') ?>
									<?php echo as_select_form($room_type, 'Tripple Room', 'tripple') ?>
									<?php echo as_select_form($room_type, 'Quad Room', 'quad') ?>
									<?php echo as_select_form($room_type, 'Queens Room', 'queens') ?>
									<?php echo as_select_form($room_type, 'Kings Room', 'kings') ?>
								</select> 
							</div>
							<div class="form-group">
								<label>Room Title</label>
								<input type="text" autocomplete="off" name="room_title" class="form-control" required value="<?php echo $room_title ?>">
							</div>
							<div class="form-group">
								<label>Room Cost</label>
								<input type="number" autocomplete="off" name="room_cost" class="form-control" required value="<?php echo $room_cost ?>">
							</div>
							<div class="form-group">
								<label>Room Image</label>
								<input type="file" accept="image/*" name="room_image" class="form-control">
							</div>
							<div class="form-group">
								<label>Room Description</label>
								<textarea id="contact_message" class="form-control" rows="6" name="room_content"  value="<?php echo $room_content ?>"></textarea>
							</div>
							<input type="submit" class="tm-submit-btn" name="SaveChanges" value="Save Changes" /><br><br>
							<input type="submit" class="tm-submit-btn" name="SaveClose" value="Save and Close" />
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