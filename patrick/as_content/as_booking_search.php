<?php include AS_THEME."as_header.php"; ?>
	<div id="site_content">	
		
<?php 
	$database = new As_Dbconn();			
	
	$search = $_GET['as_search'];
	$searchcat = $_GET['as_catid'];
	if ($searchcat<=0){
		$search_cat = "All";
		$as_db_query = "SELECT * FROM as_elibrary
		WHERE booking_title like '%$search%'
		OR booking_content like '%$search%'
		OR booking_publisher like '%$search%'
		OR booking_subject like '%$search%'";
	} else {
		$search_cat = as_cat_item($searchcat);
		$as_db_query = "SELECT * FROM as_elibrary
		WHERE booking_title like '%$search%'
		OR booking_content like '%$search%'
		OR booking_publisher like '%$search%'
		OR booking_subject like '%$search%' 
		OR booking_cat like '%$searchcat%'";
	}
	
	$results = $database->get_results( $as_db_query );
	
?>
	  <div id="content"> 
        
	  
        <div class="content_item">
		<br>
		  <h1><?php echo $database->as_num_rows( $as_db_query ) ?> Company Materials found
		  <a class="button_small" style="float:right;text-align:center;" href="index.php?page=newitem">Add New Material</a> </h1> 
          <br><hr><br>
			<div class="main_content" align="center">
			<form method="post" >
			<table style="width:100%;"><tr><td>
			<input type="text" name="as_search" id="as_search" placeholder="Search the library" value="<?php echo $search ?>" />
			</td><td>
				<select name="as_catid">
				<option  value="<?php echo $searchcat ?>"><?php echo $search_cat ?></option>
			<?php $as_cat_qry = "SELECT * FROM as_bus ORDER BY cat_title ASC";
				$cat_results = $database->get_results( $as_cat_qry );
				
				foreach( $cat_results as $as_cat ) { ?>
						<option value="<?php echo $as_cat['catid'] ?>">  <?php echo $as_cat['cat_title'] ?></option>
				<?php } ?>
				</select>
			</td>
			<td><input type="submit" style="width:200px" name="SearchThis" value="Search" /></td></tr>
			</table>
			</form>
			   <table class="tt_tb">
				<thead><tr class="tt_tr">
				  <th style="width:70px;"></th>
				  <th>Category</th>
				  <th>Title</th>
				  <th>Publisher</th>
				  <th>Subject</th>
				  <th></th>
				</tr></thead>
				<tbody>
                <?php foreach( $results as $row ) { ?>
		        <tr onclick="location='index.php?page=viewitem&amp;as_bookingid=<?php echo $row['bookingid'] ?>'">
				   <td><img class="iconic" src="as_media/<?php echo $row['booking_img'] ?>" /></td>
				   <td><?php echo as_cat_item($row['booking_cat']) ?></td>
				   <td><?php echo $row['booking_title'] ?></td>
		          <?php //echo substr($row['booking_content'],0,100).'...' ?>
				  <td><?php echo $row['booking_publisher'] ?></td>
				  <td><?php echo $row['booking_subject'] ?></td>
		          <td></td>
		        </tr>
			
			<?php } ?>
			
                      </tbody>
                    </table>
			</div>
		<br>
      <h2><center></center></h2>
		<br>  
		</div><!--close content_item-->
      </div><!--close content-->   
	</div><!--close site_content-->  	
  </div><!--close main-->
<?php include AS_THEME."as_footer.php" ?>
    
