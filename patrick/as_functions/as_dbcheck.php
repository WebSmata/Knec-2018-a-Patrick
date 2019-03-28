 <?php
	
	$database = new As_Dbconn();
	
	$As_Table_Details = array(
		'roomid int(10) unsigned NOT NULL AUTO_INCREMENT',
		'room_title varchar(50) DEFAULT NULL',
		'room_type varchar(50) DEFAULT NULL',
		'room_content varchar(100) DEFAULT NULL',
		'room_image varchar(100) DEFAULT NULL',
		'room_cost int(10) unsigned DEFAULT 0',
		'room_postedby int(10) unsigned DEFAULT 0',
		'room_posted datetime DEFAULT NULL',
		'room_updated datetime DEFAULT NULL',
		'room_updatedby int(10) DEFAULT NULL',
		'PRIMARY KEY (roomid)',
		);
	$add_query = $database->as_table_exists_create( 'as_room', $As_Table_Details ); 
	
	$As_Table_Details = array(	
		'optionid int(11) NOT NULL AUTO_INCREMENT',
		'option_title varchar(100) NOT NULL',
		'option_content varchar(2000) NOT NULL',
		'option_createdby int(10) unsigned DEFAULT NULL',
		'option_created datetime DEFAULT NULL',
		'option_updatedby int(10) unsigned DEFAULT NULL',
		'option_updated datetime DEFAULT NULL',
		'PRIMARY KEY (optionid)',
		);
	$add_query = $database->as_table_exists_create( 'as_site_options', $As_Table_Details ); 
	
	//bookingid, booking_customer, booking_checkin, booking_checkout, booking_room, booking_itemid, booking_amount, booking_payment, booking_postedby, booking_posted, booking_updated, booking_updatedby, 
	$As_Table_Details = array(
		'bookingid int(10) unsigned NOT NULL AUTO_INCREMENT',
		'booking_customer int(10) unsigned DEFAULT 0',
		'booking_checkin varchar(100) DEFAULT NULL',
		'booking_checkout varchar(100) DEFAULT NULL',
		'booking_room int(10) unsigned DEFAULT 0',
		'booking_itemid int(10) unsigned DEFAULT 0',
		'booking_amount int(10) unsigned DEFAULT 0',
		'booking_payment varchar(100) DEFAULT NULL',
		'booking_postedby int(10) unsigned DEFAULT 0',
		'booking_posted datetime DEFAULT NULL',
		'booking_updated datetime DEFAULT NULL',
		'booking_updatedby int(10) DEFAULT NULL',
		'PRIMARY KEY (bookingid)',
		);
	$add_query = $database->as_table_exists_create( 'as_booking', $As_Table_Details ); 
	
	//customerid, customer_name, customer_mobile, customer_email
	$As_Table_Details = array(	
		'customerid int(11) NOT NULL AUTO_INCREMENT',
		'customer_name varchar(50) NOT NULL',
		'customer_mobile varchar(10) NOT NULL',
		'customer_email varchar(200) NOT NULL',
		'customer_postedby int(10) unsigned DEFAULT 0',
		'customer_posted datetime DEFAULT NULL',
		'customer_updated datetime DEFAULT NULL',
		'customer_updatedby int(10) DEFAULT NULL',
		'PRIMARY KEY (customerid)',
		);
	$add_query = $database->as_table_exists_create( 'as_customer', $As_Table_Details ); 
	
	$As_Table_Details = array(	
		'userid int(11) NOT NULL AUTO_INCREMENT',
		'user_name varchar(50) NOT NULL',
		'user_fname varchar(50) NOT NULL',
		'user_lname varchar(50) NOT NULL',
		'user_mobile varchar(50) NOT NULL',
		'user_sex int(10) NOT NULL DEFAULT 1',
		'user_password text NOT NULL',
		'user_email varchar(200) NOT NULL',
		'user_group int(10) NOT NULL DEFAULT 0',
		'user_level int(10) NOT NULL DEFAULT 0',
		'user_avatar varchar(50) NOT NULL DEFAULT "user_default.jpg"',
		'user_location varchar(100) NOT NULL',
		'user_joined datetime DEFAULT NULL',
		'user_updated datetime DEFAULT NULL',
		'user_lastseen datetime DEFAULT NULL',
		'PRIMARY KEY (userid)',
		);
	$add_query = $database->as_table_exists_create( 'as_users', $As_Table_Details ); 
	