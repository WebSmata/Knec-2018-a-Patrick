<?php

function place_all() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "All Company Items"; 
	
	if ( isset( $_POST['SearchThis'])) {
		$as_search = $_POST['as_search'];
		$as_catid = $_POST['as_catid'];
		
		header( "Location: index.php?page=as_search&&as_search=".$as_search."&&as_catid=".$as_catid);
								
	}  else {	
		require( AS_INC . "as_place_all.php" );
	}
}

function place_search() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Search"; 
	$results['search'] = isset( $_GET['as_placeid'] ) ? $_GET['as_placeid'] : "";
	$results['searchcat'] = isset( $_GET['as_catid'] ) ? $_GET['as_catid'] : "";
	
	if ( isset( $_POST['SearchThis'])) {
		$as_search = $_POST['as_search'];
		$as_catid = $_POST['as_catid'];
		
		header( "Location: index.php?page=as_search&&as_search=".$as_search."&&as_catid=".$as_catid);
														
	}  else {	
		require( AS_INC . "as_search.php" );
	}
}

function place_new() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Newplace"; 
	
	if ( isset( $_POST['AddItem'])) {
		as_add_new_place();	
		header( "Location: index.php?page=place_new");						
	} else if ( isset( $_POST['AddClose'])) {
		as_add_new_place();	
		header( "Location: index.php?page=place_all");						
	} else {
		require( AS_INC . "as_place_new.php" );
	}
}

function place_view() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Viewitem"; 
	$as_placeid = isset( $_GET['as_placeid'] ) ? $_GET['as_placeid'] : "";
	
	$as_db_query = "SELECT * FROM as_place WHERE placeid = '$as_placeid'";
	$database = new As_Dbconn();
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
		list( $placeid, $user_name) = $database->get_row( $as_db_query );
		$results['item'] = $placeid;
	} else  {
		return false;
		header( "Location: index.php?page=place_all");	
	}
	
	if ( isset( $_POST['OrderNow'])) {
		as_add_new_order();
		header( "Location: index.php?page=order_all");				
	}  else {
		require( AS_INC . "as_place_view.php" );
	}	
	
}

function place_edit() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Edititem"; 
	$as_placeid = isset( $_GET['as_placeid'] ) ? $_GET['as_placeid'] : "";
	$results['pageItem'] = $as_placeid;
	
	if ( isset( $_POST['SaveChanges'])) {
		as_edit_place($as_placeid);
		header( "Location: index.php?page=place_view&&as_placeid=".$as_placeid);					
	}  else {
		require( AS_INC . "as_place_edit.php" );
	}
}

function place_delete() {
	$as_placeid = isset( $_GET['as_placeid'] ) ? $_GET['as_placeid'] : "";
	
	$database = new As_Dbconn();
	$as_db_query = "DELETE * FROM as_place WHERE placeid = '$as_placeid'";
	$delete = array(
		'placeid' => $as_placeid,
	);
	$deleted = $database->delete( 'as_place', $delete, 1 );
	if( $deleted )	{
		header( "Location: index.php?page=place_all");	
	}
}
	
function user_all() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Users";  
	require( AS_INC . "as_user_all.php" );
}

function user_new() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Newuser"; 
	
	if ( isset( $_POST['AddEmployee'])) {
		as_add_new_user();
		header( "Location: index.php?page=user_new");						
	}  else if ( isset( $_POST['AddClose'])) {
		as_add_new_user();
		header( "Location: index.php?page=user_all");						
	}  else {
		require( AS_INC . "as_user_new.php" );
	}	
	
}
function user_view() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Viewuser"; 
	$as_userid = isset( $_GET['as_userid'] ) ? $_GET['as_userid'] : "";
	
	$as_db_query = "SELECT * FROM as_user WHERE userid = '$as_userid'";
	$database = new As_Dbconn();
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
		list( $userid, $user_name) = $database->get_row( $as_db_query );
		$results['user'] = $userid;
	} else  {
		return false;
		header( "Location: index.php?page=user_all");	
	}
	
	require( AS_INC . "as_user_view.php" );
		
}

function profile() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Profile"; 
	$as_username = $_SESSION['site_user'];
	
	$as_db_query = "SELECT * FROM as_user WHERE user_name = '$as_username'";
	$database = new As_Dbconn();
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
		list( $userid, $user_name) = $database->get_row( $as_db_query );
		$results['user'] = $userid;
	} else  {
		return false;
		header( "Location: index.php?page=users");	
	}
	
	require( AS_INC . "as_viewuser.php" );
		
}

	
function register() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Register"; 
	
	if ( isset( $_POST['Register'] ) ) {
		as_register_me();
		header( "Location: index.php");		
	}  else {
		require( AS_INC . "as_signup.php" );
	}	
	
}

function booking_all() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "All Company Items"; 
	
	if ( isset( $_POST['SearchThis'])) {
		$as_search = $_POST['as_search'];
		$as_catid = $_POST['as_catid'];
		
		header( "Location: index.php?page=as_search&&as_search=".$as_search."&&as_catid=".$as_catid);
								
	}  else {	
		require( AS_INC . "as_booking_all.php" );
	}
}

function booking_view() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Viewitem"; 
	$as_bookingid = isset( $_GET['as_bookingid'] ) ? $_GET['as_bookingid'] : "";
	
	$as_db_query = "SELECT * FROM as_booking WHERE bookingid = '$as_bookingid'";
	$database = new As_Dbconn();
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
		list( $bookingid, $user_name) = $database->get_row( $as_db_query );
		$results['item'] = $bookingid;
	} else  {
		return false;
		header( "Location: index.php?page=booking_all");	
	}
	
	require( AS_INC . "as_booking_view.php" );
}

function booking_edit() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Edititem"; 
	$as_bookingid = isset( $_GET['as_bookingid'] ) ? $_GET['as_bookingid'] : "";
	
	$as_db_query = "SELECT * FROM as_booking WHERE bookingid = '$as_bookingid'";
	$database = new As_Dbconn();
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
		list( $bookingid) = $database->get_row( $as_db_query );
		$results['item'] = $bookingid;
	} else  {
		return false;
		header( "Location: index.php?page=elibrary");	
	}
	
	if ( isset( $_POST['EditTicket'])) {
		as_edit_booking($as_bookingid);
		header( "Location: index.php?page=booking_view&&as_bookingid=".$as_bookingid);					
	}  else {
		require( AS_INC . "as_booking_edit.php" );
	}	
	
}

function booking_delete() {
	$as_bookingid = isset( $_GET['as_bookingid'] ) ? $_GET['as_bookingid'] : "";
	
	$database = new As_Dbconn();
	$as_db_query = "DELETE * FROM as_booking WHERE bookingid = '$as_bookingid'";
	$delete = array(
		'bookingid' => $as_bookingid,
	);
	$deleted = $database->delete( 'as_booking', $delete, 1 );
	if( $deleted )	{
		header( "Location: index.php?page=booking_all");	
	}
}

function room_all() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "All Company Items"; 
	
	if ( isset( $_POST['SearchThis'])) {
		$as_search = $_POST['as_search'];
		$as_catid = $_POST['as_catid'];
		
		header( "Location: index.php?page=as_search&&as_search=".$as_search."&&as_catid=".$as_catid);
								
	}  else {	
		require( AS_INC . "as_room_all.php" );
	}
}

function room_new() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Newroom"; 
	
	if ( isset( $_POST['AddItem'])) {
		as_add_new_room();	
		header( "Location: index.php?page=room_new");						
	} else if ( isset( $_POST['AddClose'])) {
		as_add_new_room();
		header( "Location: index.php?page=room_all");						
	} else {
		require( AS_INC . "as_room_new.php" );
	}
}

function room_view() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Viewitem"; 
	$as_roomid = isset( $_GET['as_roomid'] ) ? $_GET['as_roomid'] : "";
	
	$as_db_query = "SELECT * FROM as_room WHERE roomid = '$as_roomid'";
	$database = new As_Dbconn();
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
		list( $roomid, $user_name) = $database->get_row( $as_db_query );
		$results['item'] = $roomid;
	} else  {
		return false;
		header( "Location: index.php?page=room_all");	
	}
	
	if ( isset( $_POST['OrderNow'])) {
		as_add_new_order();
		header( "Location: index.php?page=order_all");				
	}  else {
		require( AS_INC . "as_room_view.php" );
	}	
	
}

function room_edit() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Edititem"; 
	$as_roomid = isset( $_GET['as_roomid'] ) ? $_GET['as_roomid'] : "";
	$results['pageItem'] = $as_roomid;
	
	if ( isset( $_POST['SaveChanges'])) {
		as_edit_room($as_roomid);
		header( "Location: index.php?page=room_view&&as_roomid=".$as_roomid);					
	}  else {
		require( AS_INC . "as_room_edit.php" );
	}	
	
}

function room_delete() {
	$as_roomid = isset( $_GET['as_roomid'] ) ? $_GET['as_roomid'] : "";
	
	$database = new As_Dbconn();
	$as_db_query = "DELETE * FROM as_room WHERE roomid = '$as_roomid'";
	$delete = array(
		'roomid' => $as_roomid,
	);
	$deleted = $database->delete( 'as_room', $delete, 1 );
	if( $deleted )	{
		header( "Location: index.php?page=room_all");	
	}
}

?>