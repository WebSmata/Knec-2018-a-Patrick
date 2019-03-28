<?php
	// POSTING FUNCTIONS
	// Begin Posting Functions 
	
	function as_slug_this($content) {
		return preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($content)));
	}
	
	function as_slug_is(){
		if(empty($_POST['slug'])) {
		    $as_slug = trim($_POST['slug']);
		} else $as_slug = as_slug_this($_POST['title']);
		
	}
		
	function as_add_admin($admin_username) {		
		$database = new As_Dbconn();	
		$Update_Admin_Details = array(
			'user_group' => trim($_POST['admin_role']),
		);
		$where_clause = array('user_name' => $admin_username);
		$updated = $database->as_update( 'as_user', $Update_Admin_Details, $where_clause, 1 );
		if( $updated )	{	}
	
	}
 	
	function as_add_new_room(){
		$database = new As_Dbconn();
		$raw_file_name = basename($_FILES["room_image"]["name"]);
		$temp_file_name = $_FILES["room_image"]["tmp_name"];		
		$upload_file_ext = explode(".", $raw_file_name);
		$upload_file_name = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "_", strtolower($upload_file_ext[0])));
		$finalname = 'image_'.time().'.'.$upload_file_ext[1];
		$target_file = "./as_media/posts/" .  $finalname;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);	
		if (copy($temp_file_name, $target_file)) $imagefinal = $finalname;
		else $imagefinal = "no_image.jpg";		
				
		$New_Item_Details = array(
			'room_title' => trim($_POST['room_title']),
			'room_type' => trim($_POST['room_type']),
			'room_cost' => trim($_POST['room_cost']),
			'room_content' => trim($_POST['room_content']),
			'room_image' => $imagefinal,
		    'room_posted' => date('Y-m-d H:i:s'),
		    'room_postedby' => "1",
		);
			
		$add_query = $database->as_insert( 'as_room', $New_Item_Details ); 
	}
	
	function as_add_new_booking(){
		$database = new As_Dbconn();
		$New_Customer_Details = array(
			'customer_name' => trim($_POST['customer_name']),
			'customer_mobile' => trim($_POST['customer_mobile']),
			'customer_email' => trim($_POST['customer_email']),
		    'customer_posted' => date('Y-m-d H:i:s'),
		    'customer_postedby' => "1",
		);
		$add_query = $database->as_insert( 'as_customer', $New_Customer_Details ); 
		$customerid = $database->lastid();
		
		$New_Booking_Details = array(
			'booking_customer' 	=> $customerid,
			'booking_checkin' 	=> trim($_POST['booking_checkin']),
			'booking_checkout' 	=> trim($_POST['booking_checkout']),
			'booking_room' 		=> trim($_POST['booking_room']),
			'booking_itemid' 	=> trim($_POST['booking_itemid']),
			'booking_amount' 	=> trim($_POST['booking_amount']),
		    'booking_posted' 	=> date('Y-m-d H:i:s'),
		    'booking_postedby' 	=> "1",
		);
			
		$add_query = $database->as_insert( 'as_booking', $New_Booking_Details ); 
		return $database->lastid();
	}
	
	function as_edit_booking($bookingid) {
		$database = new As_Dbconn();	
		$Update_Item_Details = array(
			'booking_name' => trim($_POST['booking_name']),
			'booking_mobile' => trim($_POST['booking_mobile']),
			'booking_date' => trim($_POST['booking_date']),
			'booking_class' => trim($_POST['booking_class']),
			'booking_roomid' => trim($_POST['booking_roomid']),
			'booking_booking' => trim($_POST['booking_booking']),
			'booking_amount' => trim($_POST['booking_amount']),
			'booking_payment' => trim($_POST['booking_payment']),
		    'booking_updated' => date('Y-m-d H:i:s'),
		    'booking_updatedby' => "1",
		);
		$where_clause = array('bookingid' => $bookingid);
		$updated = $database->as_update( 'as_booking', $Update_Item_Details, $where_clause, 1 );
		if( $updated )	{	}
	}
	
	function as_edit_room($roomid) {
		$database = new As_Dbconn();
		$raw_file_name = basename($_FILES["room_image"]["name"]);
		$temp_file_name = $_FILES["room_image"]["tmp_name"];		
		$upload_file_ext = explode(".", $raw_file_name);
		$upload_file_name = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "_", strtolower($upload_file_ext[0])));
		$finalname = 'image_'.time().'.'.$upload_file_ext[1];
		$target_file = "./as_media/posts/" .  $finalname;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);	
		if (copy($temp_file_name, $target_file)) $imagefinal = $finalname;
		else $imagefinal = trim($_POST['room_imaged']);		
				
		$Item_Details = array(
			'room_title' => trim($_POST['room_title']),
			'room_type' => trim($_POST['room_type']),
			'room_cost' => trim($_POST['room_cost']),
			'room_content' => trim($_POST['room_content']),
			'room_image' => $imagefinal,
		    'room_updated' => date('Y-m-d H:i:s'),
		    'room_updatedby' => "1",
		);
		$where_clause = array('roomid' => $roomid);
		$updated = $database->as_update( 'as_room', $Item_Details, $where_clause, 1 );
		if( $updated )	{	}
	}
		
	function as_checkout_room($bookingid) {
		$database = new As_Dbconn();	
		$database = new As_Dbconn();	
		$Update_Item_Details = array(
			'booking_roomid' => 0,
		);
		$where_clause = array('bookingid' => $bookingid);
		$updated = $database->as_update( 'as_booking', $Update_Item_Details, $where_clause, 1 );
	}
	