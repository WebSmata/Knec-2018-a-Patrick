<?php
	function as_account_signin(){
		$database = new As_Dbconn();
		$inloginname = $_POST['loginname'];
		$inloginkey = md5($_POST['loginkey']);
		if (strpos($inloginname, '@')!==false) {// handles can't contain @ symbols
			$matchusers=as_db_user_find_by_email($inloginname);
		} else {
			$matchusers=as_db_user_find_by_username($inloginname);
		}
		
		if (count($matchusers)==1) { 
			$inuserid = $matchusers[0];
			$as_db_query = "SELECT * FROM as_users WHERE userid=$inuserid AND user_password='$inloginkey'";
			if( $database->as_num_rows( $as_db_query ) > 0 ) {
				$_SESSION['whiterhino_userid'] = $inuserid;	
				//$_SESSION['rosesite_level'] = $user_level;
			} 
		} 
	}
	
	function as_db_user_find_by_username($username)
	{
		$as_db_query = "SELECT * FROM as_users WHERE user_name='$username'";
		$database = new As_Dbconn();		
		$results = $database->get_results( $as_db_query );
		foreach( $results as $row )
		{
		    return $row['userid'];                  
		}	
	}
	
	function as_db_user_find_by_email($email)
	{
		$database = new As_Dbconn();		
		$as_db_query = "SELECT * FROM as_users WHERE user_email='$email'";
		$results = $database->get_results( $as_db_query );
		foreach( $results as $row )
		{
		    return $row['userid'];                  
		}			
	}
	
	function as_signin() {
		$loginname = $_POST['username'];
		$loginkey = md5($_POST['password']);
		$database = new As_Dbconn();
		$as_db_query = "SELECT * FROM as_user WHERE user_name = '$loginname' AND user_password = '$loginkey'
								OR user_email =$loginname' AND user_password = '$loginkey'";
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
			 list( $userid, $user_name) = $database->get_row( $as_db_query );
			$_SESSION['userid'] = $userid;
			return true;
		} else return false;
	}

	function as_let_me_user($loginname, $loginkey) {
		$as_db_query = "SELECT * FROM as_user WHERE user_name = '$loginname' AND user_password = '$loginkey'
			OR user_email ='$loginname' AND user_password = '$loginkey'";
		$database = new As_Dbconn();
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
            list( $userid, $user_name, ) = $database->get_row( $as_db_query );
		    return $user_name;
		} else return false;
	}
	
	function as_logged_account($loginname) {
		$as_db_query = "SELECT * FROM as_user 
				WHERE user_name = '$loginname' 
					OR user_email ='$loginname'";
		$database = new As_Dbconn();
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
            list( $userid, $user_name, $user_fname, $user_surname, $user_sex, $user_password, $user_email, $user_group) = $database->get_row( $as_db_query );
		    return $user_group;
		} else  {
		    return false;
		}
		
	}
	
	function as_recover_username($email, $password) {
		$as_db_query = "SELECT * FROM as_user WHERE user_email = '$email' AND user_password = '$password'";
		$database = new As_Dbconn();
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
            list( $userid, $user_name) = $database->get_row( $as_db_query );			
			$_SESSION['recover_username'] = $user_name;
		    return true;
		} else  {
		    return false;
		}
		
	}
	
	function as_recover_password($username, $email) {
		$as_db_query = "SELECT * FROM as_user WHERE user_email = '$email' AND user_name = '$username'";
		$database = new As_Dbconn();
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
            list( $userid, $user_name) = $database->get_row( $as_db_query );
			$_SESSION['recover_password'] = $user_name;
		    return true;
		} else  {
		    return false;
		}		
	}
	
	function as_change_password($username) {		
		$database = new As_Dbconn();	
		$Update_User_Details = array(
			'user_password' => md5($_POST['passwordcon']),
		);
		$where_clause = array('user_name' => $username);
		$updated = $database->as_update( 'as_user', $Update_User_Details, $where_clause, 1 );
		if( $updated )	{	}
	
	}
	
	function as_is_logged(){
		$myloginid = isset( $_SESSION['site_user'] ) ? $_SESSION['site_user'] : "";
		
		if (!$myloginid) return true;
		else return false;
	}
	
	function as_signin_modal() {
	  if ( isset( $_POST['LetMeIn'] ) ) {
		$loginname = $_POST['loginname'];
		$loginkey = md5($_POST['loginkey']);
		
		$as_db_query = "SELECT * FROM as_user 
			WHERE user_name = '$loginname' AND user_password = '$loginkey'
			OR user_email ='$loginname' AND user_password = '$loginkey'";
		$database = new As_Dbconn();
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
            list( $userid) = $database->get_row( $as_db_query );
		    $_SESSION['site_user'] = $userid;			
			header( "Location: ".as_siteUrl());		
		} else header( "Location: ".as_siteLynk()."signin" );	
	  }
	} 
	
	function logout() {
		unset( $_SESSION['site_user'] );
		unset( $_SESSION['site_account'] );
		header( "Location: index.php" );
	}
	
	function as_register(){
 		$raw_file_name = basename($_FILES["avatar"]["name"]);
		$temp_file_name = $_FILES["avatar"]["tmp_name"];		
		$upload_file_ext = explode(".", $raw_file_name);
		$upload_file_name = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "_", strtolower($upload_file_ext[0])));
		$finalname = 'user'.time().'.'.$upload_file_ext[1];
		$target_file = AS_TARGET . $finalname;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);		
		if (move_uploaded_file($temp_file_name, $target_file)) $as_avatar = $finalname;
		else $as_avatar = "user_default.jpg";		
			 
		$database = new As_Dbconn();			
		$New_User_Details = array(			
			'user_name' => trim($_POST['username']),
			'user_fname' => trim($_POST['fname']),
			'user_surname' => trim($_POST['surname']),
			'user_password' => md5(trim($_POST['password'])),
			'user_email' => trim($_POST['email']),
			'user_mobile' => trim($_POST['mobile']),
			'user_joined' => date('Y-m-d H:i:s'),
		);
			
		$add_query = $database->as_insert( 'as_user', $New_User_Details ); 
		if ($add_query ) return true;
		else return false;
	}
	
	function as_register_me(){
 		$raw_file_name = basename($_FILES["avatar"]["name"]);
		$temp_file_name = $_FILES["avatar"]["tmp_name"];		
		$upload_file_ext = explode(".", $raw_file_name);
		$upload_file_name = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "_", strtolower($upload_file_ext[0])));
		$finalname = 'user'.time().'.'.$upload_file_ext[1];
		$target_file = AS_TARGET . $finalname;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);		
		if (move_uploaded_file($temp_file_name, $target_file)) $as_avatar = $finalname;
		else $as_avatar = "user_default.jpg";		
			 
		$database = new As_Dbconn();			
		$New_User_Details = array(			
			'user_name' => trim($_POST['username']),
			'user_fname' => trim($_POST['fname']),
			'user_surname' => trim($_POST['surname']),
			'user_password' => md5(trim($_POST['passwordcon'])),
			'user_email' => trim($_POST['email']),
			'user_mobile' => trim($_POST['mobile']),
			'user_group' => 'student',
			'user_avatar' => trim($as_avatar),
			'user_joined' => date('Y-m-d H:i:s'),
		);
			
		$add_query = $database->as_insert( 'as_user', $New_User_Details ); 
	}
	
		
	function as_add_new_supp(){
 		$raw_file_name = basename($_FILES["avatar"]["name"]);
		$temp_file_name = $_FILES["avatar"]["tmp_name"];		
		$upload_file_ext = explode(".", $raw_file_name);
		$upload_file_name = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "_", strtolower($upload_file_ext[0])));
		$finalname = 'supp'.time().'.'.$upload_file_ext[1];
		$target_file = AS_TARGET . $finalname;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);		
		if (move_uploaded_file($temp_file_name, $target_file)) $as_avatar = $finalname;
		else $as_avatar = "supp_default.jpg";		
			 
		$database = new As_Dbconn();			
		$New_User_Details = array(			
			'supp_name' => trim($_POST['suppname']),
			'supp_fullname' => trim($_POST['fullname']),
			'supp_email' => trim($_POST['email']),
			'supp_mobile' => trim($_POST['mobile']),
			'supp_address' => trim($_POST['address']),
			'supp_avatar' => trim($as_avatar),
			'supp_joined' => date('Y-m-d H:i:s'),
		);
			
		$add_query = $database->as_insert( 'as_supplier', $New_User_Details ); 
	}
	
	
?>
	