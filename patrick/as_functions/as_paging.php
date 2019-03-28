<?php
	// PAGES FUNCTIONS
	// Begin Pages Functions 
	
	function my_booking_roomt($roomtno) {
		$my_db_query = "SELECT * FROM my_bus WHERE catid = '$roomtno'";
		$database = new As_Dbconn();
		if( $database->my_num_rows( $my_db_query ) > 0 ) {
                    list( $catid, $cat_slug, $cat_title) = $database->get_row( $my_db_query );
		    return $cat_title;
		} else  {
		    return false;
		}
		
	}
	

	function my_booking_seller($userid, $infor) {
		$my_db_query = "SELECT * FROM my_user_account WHERE userid = '$userid'";
		$database = new As_Dbconn();
		if( $database->my_num_rows( $my_db_query ) > 0 ) {
                    list( $userid, $user_name, $user_fname, $user_surname, $user_sex, $user_password, $user_email, $user_group, $user_points, $user_bio, $user_mailcon, $user_joined, $user_mobile, $user_web, $user_location, $user_security_quiz, $user_security_ans, $user_avatar) = $database->get_row( $my_db_query );
		    return $infor;
		} else  {
		    return false;
		}
		
	}
	
		
    function my_cat_items(){
		$my_db_query = "SELECT * FROM my_bus";
		$database = new As_Dbconn();
		
		$results = $database->get_results( $my_db_query );
		foreach( $results as $row )
		{
		    	return '<option value="'.$row['catid'].'">'.$row['cat_title'].'</option>';		                            
		}			
	}

	function my_latest_catitems($catid){
		$my_db_query = "SELECT * FROM my_item WHERE booking_cat = '$catid' LIMIT 4";
		$database = new As_Dbconn();
		
		$results = $database->get_results( $my_db_query );
		foreach( $results as $row )
		{
		    echo '';
		}

				
	}
	
	function my_latest_cat_items_home(){
		$my_db_query = "SELECT * FROM my_bus";
		$database = new As_Dbconn();
		
		$booking_cats = $database->get_results( $my_db_query );
		foreach( $booking_cats as $cat )
		{
		    $booking_cat = $cat['catid'];
			
			$my_cat_items_query = "SELECT * FROM my_item WHERE booking_cat = '$booking_cat' LIMIT 4";
			
			if ($my_cat_items_query) {
				echo '<hr><h3>'.$cat['cat_title'].'</h3>
				   <div class="row">
					<div class="productsrow">';
			}	
				$database = new As_Dbconn();
				
				$cat_items = $database->get_results( $my_cat_items_query );
				foreach( $cat_items as $row )
				{
					echo '<div class="product menu-bus">
									
					<a href="'.my_siteLynk().$row['booking_slug'].'"><div class="product-image">
						<img class="product-image menu-item list-group-item" src="'.my_siteLynk_img().$row['booking_img'].'">
					</div></a> <a href="'.my_siteLynk().$row['booking_slug'].'" class="menu-item list-group-item">'.substr($row['booking_title'],0,20).'<span class="badge">KSh '.$row['booking_price'].'</span></a></div>';
				}
		   
				echo '</div></div>';
				
		}				
	}
	
	function my_latest_cat_items(){
	$my_db_query = "SELECT * FROM my_item LIMIT 4";
	$database = new As_Dbconn();
	
	$results = $database->get_results( $my_db_query );
	foreach( $results as $row )
	{
		echo '<div class="product menu-bus">
				<a href="'.my_siteLynk().$row['booking_slug'].'"><div class="menu-bus-name list-group-item active">'.my_booking_roomt($row['booking_cat']).'</div></a>
				<a href="'.my_siteLynk().$row['booking_slug'].'"><div class="product-image">
					<img class="product-image menu-item list-group-item" src="'.my_siteLynk_img().$row['booking_img'].'" />
				</div></a> <a href="'.my_siteLynk().$row['booking_slug'].'" class="menu-item list-group-item">'.substr($row['booking_title'],0,20).'<span class="badge">KSh '.$row['booking_price'].'</span></a>

			</div>';
	}

			
	}

	function my_home_categories(){
		$my_db_query = "SELECT * FROM my_bus LIMIT 9";
		$database = new As_Dbconn();		
		$results = $database->get_results( $my_db_query );
		foreach( $results as $row ) {
			echo '<a href="'.my_siteLynk().$row['cat_slug'].'" >
			<div class="cat_lynk"><img class="cat_icon" src="'.my_siteLynk_icon().$row['cat_icon'].'"/>
			'.$row['cat_title'].'</div></a>';
	   }				
	}

	function my_lookup_cat($request){
		$my_db_query = "SELECT * FROM my_bus WHERE cat_slug = '$request'";
		$database = new As_Dbconn();
		if( $database->my_num_rows( $my_db_query ) > 0 ) { return true; } 
		else  { return false; }
	}
	
	function my_lookup_user($request){
		$my_db_query = "SELECT * FROM my_user_account WHERE user_name = '$request'";
		$database = new As_Dbconn();
		if( $database->my_num_rows( $my_db_query ) > 0 ) { return true; } 
		else  { return false; }
	}
	
	function my_lookup_loc($request){
		$my_db_query = "SELECT * FROM my_location WHERE slug = '$request'";
		$database = new As_Dbconn();
		if( $database->my_num_rows( $my_db_query ) > 0 ) { return true; } 
		else  { return false; }
	}
	
	function my_lookup_item($request){
		$my_db_query = "SELECT * FROM my_item WHERE booking_slug = '$request'";
		$database = new As_Dbconn();
		if( $database->my_num_rows( $my_db_query ) > 0 ) { return true; } 
		else  { return false; }
	}
