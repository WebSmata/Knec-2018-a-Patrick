<?php
	session_start();
	
	if (!file_exists(AS_BASE.'as_config.php')) as_fatal_error('The config file could not be found!');
	require_once AS_BASE.'as_config.php';

	require AS_FUNC.'as_base.php';
	require AS_FUNC.'as_users.php';
	require AS_FUNC.'as_posting.php';
		
 	$as_loginid = isset( $_SESSION['site_user'] ) ? $_SESSION['site_user'] : "";
	
	$page = isset( $_GET['page'] ) ? $_GET['page'] : "";
	$myaccount = isset( $_SESSION['site_account'] ) ? $_SESSION['site_account'] : "";
	
  switch ( $page ) {
	case 'login': as_login();
		break;
	case 'register': register();
		break;
	case 'forgot_password': forgot_password();
		break;
	case 'recover_password': recover_password();
		break;
	case 'forgot_username': forgot_username();
		break;
	case 'recover_username': recover_username();
		break;
	case 'logout': logout();
		break;
	case 'book_now':  book_now();
		break;
	case 'booking_all': booking_all();
		break;
	case 'booking_view': booking_view();
		break;
	case 'booking_edit':  booking_edit();
		break;
	case 'booking_delete':  booking_delete();
		break;
	case 'room_all': room_all();
		break;
	case 'room_new': room_new();
		break;
	case 'room_view': room_view();
		break;
	case 'room_edit':  room_edit();
		break;
	case 'room_delete':  room_delete();
		break;
	case 'checkin':  as_checkin();
		break;
	case 'checkout':  as_checkout();
		break;
	case 'booking': as_booking();
		break;
	case 'user_all': user_all();
		break;
	case 'user_new':  user_new();
		break;
	case 'user_view': user_view();
		break;
	case 'customer_all': customer_all();
		break;
	case 'customer_new':  customer_new();
		break;
	case 'customer_view': customer_view();
		break;
	case 'profile': 
		if ($myaccount) as_profile();
		break;
	case 'administrator': as_admin();
		break;
	case 'options':  as_options();
		break;
    default:
		as_homepage();
}

function as_checkin() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Newbooking"; 
	
	if ( isset( $_POST['FinishCheckin'])) {
		$bookingid = as_add_new_booking();	
		header( "Location: index.php?page=booking&&as_bookingid=".$bookingid);						
	} else if ( isset( $_POST['CancelCheckin'])) {
		header( "Location: index.php");						
	} else {
		require( "as_booking_new.php" );
	}	
	
}

function as_booking() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Newbooking"; 
	
	require( "as_booking_view.php" );
}

function as_checkout() {
	$as_roomid = isset( $_GET['as_roomid'] ) ? $_GET['as_roomid'] : "";
	as_checkout_room($as_roomid);
	header( "Location: index.php");	
}

function as_homepage() {
	$results = array();
	$results['pageTitle'] = "My System";
	$results['pageAction'] = "Dashboard"; 
	
	if ( isset( $_POST['CheckNowRoom'] ) ) {
		$roomtype 	= $_POST['roomtype'];
		$datein 	= $_POST['datein'];
		$dateout 	= $_POST['dateout'];
		header( "Location: index.php?page=checkin&&roomtype=".$roomtype."&&datein=".$datein."&&dateout=".$datein);
	}  else {	
		require( "as_homepage.php" );
	}
	
}

function as_admin() {
	$results = array();
	$results['pageTitle'] = "My System";
	$results['pageAction'] = "Dashboard"; 
	
	require( "as_admin.php" );
}

function as_options() {
	$results = array();
	$results['pageTitle'] = "My System";
	$results['pageAction'] = "Options"; 
	$as_loginid = isset( $_SESSION['site_user'] ) ? $_SESSION['site_user'] : "";
	
	if ( isset( $_POST['SaveSite'] ) ) {
			
		as_set_option('sitename', $_POST['sitename'], $as_loginid);	
		as_set_option('keywords', $_POST['keywords'], $as_loginid);
		as_set_option('description', $_POST['description'], $as_loginid);
		as_set_option('siteurl', $_POST['siteurl'], $as_loginid);
		
		header( "Location: index.php?page=options");						
	}  else if ( isset( $_POST['CancelSave'] ) ) {
		header( "Location: index.php?page=options");						
	}  else {
		require( "as_options.php" );
	}
	
}

function as_login() {
	$results = array();
	$results['pageTitle'] = "My System";
	$results['pageAction'] = "Sign in";
	
	if ( isset( $_POST['SignMeIn'] ) ) {
		as_account_signin();
		header( "Location: index.php");						
	}  else {
		require( "as_login.php" );
	}
	
}
	
function user_all() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Users";  
	require( "as_user_all.php" );
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
		require( "as_user_new.php" );
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
	
	require( "as_user_view.php" );
		
}
	
function customer_all() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Users";  
	require( "as_customer_all.php" );
}

function customer_new() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Newcustomer"; 
	
	if ( isset( $_POST['AddEmployee'])) {
		as_add_new_customer();
		header( "Location: index.php?page=customer_new");						
	}  else if ( isset( $_POST['AddClose'])) {
		as_add_new_customer();
		header( "Location: index.php?page=customer_all");						
	}  else {
		require( "as_customer_new.php" );
	}	
	
}

function customer_view() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Viewcustomer"; 
	$as_customerid = isset( $_GET['as_customerid'] ) ? $_GET['as_customerid'] : "";
	
	$as_db_query = "SELECT * FROM as_customer WHERE customerid = '$as_customerid'";
	$database = new As_Dbconn();
	if( $database->as_num_rows( $as_db_query ) > 0 ) {
		list( $customerid, $customer_name) = $database->get_row( $as_db_query );
		$results['customer'] = $customerid;
	} else  {
		return false;
		header( "Location: index.php?page=customer_all");
	}
	require( "as_customer_view.php" );
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
	
	require( "as_viewuser.php" );
		
}

	
function register() {
	$results = array();
	$results['pageTitle'] = "Management System";
	$results['pageAction'] = "Register"; 
	
	if ( isset( $_POST['Register'] ) ) {
		as_register_me();
		header( "Location: index.php");		
	}  else {
		require( "as_signup.php" );
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
		require( "as_booking_all.php" );
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
	
	require( "as_booking_view.php" );
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
		require( "as_room_all.php" );
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
		require( "as_room_new.php" );
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
		require( "as_room_view.php" );
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
	}  else if ( isset( $_POST['SaveClose'])) {
		as_edit_room($as_roomid);
		header( "Location: index.php?page=room_all");					
	}  else {
		require( "as_room_edit.php" );
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