<?php
	
	// OPTIONS FUNCTIONS
	// Begin Options Functions 
	
	function as_selected_room($itemid) {
		$database = new As_Dbconn();
		$as_db_query = "SELECT * FROM as_room WHERE roomid=$itemid";
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
			list( $roomid, $room_title) = $database->get_row( $as_db_query );
			return $room_title;
		} else return "Invalid Name";
	}
	
	function as_selected_place($itemid) {
		$database = new As_Dbconn();
		$as_db_query = "SELECT * FROM as_place WHERE placeid=$itemid";
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
			list( $placeid, $place_title) = $database->get_row( $as_db_query );
			return $place_title;
		} else return "Invalid Name";
	}

	function as_selected_room_cost($itemid) {
		$database = new As_Dbconn();
		$as_db_query = "SELECT * FROM as_room WHERE roomid=$itemid";
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
			list( $roomid, $room_title, $room_content, $room_image, $room_cost) = $database->get_row( $as_db_query );
			return $room_cost;
		} else return "Invalid Name";
	}
	
	function as_selected_place_cost($itemid) {
		$database = new As_Dbconn();
		$as_db_query = "SELECT * FROM as_place WHERE placeid=$itemid";
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
			list( $placeid, $place_title, $place_content, $place_image, $place_cost) = $database->get_row( $as_db_query );
			return $place_cost;
		} else return "Invalid Name";
	}

	function as_where1($int){
		if ($int == 1) return 'Room';
		else return 'Place';
	}
	
	function as_where2($int){
		if ($int == 1) return 'as_room';
		else return 'as_place';
	}
	
	function as_select_if($itemvl, $setvl){
		if ($itemvl == $setvl) return 'value='.$itemvl.' selected';
		else return 'value='.$itemvl;
	}
	
	function as_room_class($class){
		if ($class == 1) return 'Normal';
		else if ($class == 2) return 'VIP';
		else if ($class == 3) return 'VVIP';
	}
	
	function as_book_vl($booking){
		if ($booking == 1) return 'Normal';
		else if ($booking == 2) return 'Advance';
	}
	
	function as_select_form($value, $option, $optionvl){
	return '<option value="'.$optionvl.'"'.(($optionvl == $value) ? ' selected' : '').'>'.$option.'</option>'."\n\t\t\t";
}	
