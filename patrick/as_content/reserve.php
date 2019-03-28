
	function as_add_new_place(){
		$database = new As_Dbconn();
		$raw_file_name = basename($_FILES["place_image"]["name"]);
		$temp_file_name = $_FILES["place_image"]["tmp_name"];		
		$upload_file_ext = explode(".", $raw_file_name);
		$upload_file_name = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "_", strtolower($upload_file_ext[0])));
		$finalname = 'image_'.time().'.'.$upload_file_ext[1];
		$target_file = "./as_media/posts/" .  $finalname;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);	
		if (copy($temp_file_name, $target_file)) $imagefinal = $finalname;
		else $imagefinal = "no_image.jpg";		
				
		$New_Item_Details = array(
			'place_title' => trim($_POST['place_title']),
			'place_cost' => trim($_POST['place_cost']),
			'place_content' => trim($_POST['place_content']),
			'place_image' => $imagefinal,
		    'place_posted' => date('Y-m-d H:i:s'),
		    'place_postedby' => "1",
		);
			
		$add_query = $database->as_insert( 'as_place', $New_Item_Details ); 
	}
	