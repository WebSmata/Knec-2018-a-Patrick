<?php include AS_THEME."as_header.php";
	$database = new As_Dbconn();
	$as_db_query = "SELECT * FROM as_room ORDER BY roomid ASC";
	$results = $database->get_results( $as_db_query );
?>
	<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h3><?php echo $database->as_num_rows( $as_db_query ) ?> Rooms | 
					<a href="index.php?page=room_new"> + Room </a>
					</h3></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>				
			</div>
			<div class="row">
				<!-- contact form -->
				<div class="tm-contact-form">
					<div class="col-lg-1 col-md-1 col-md-1">
						<div class="contact-social">
							
						</div>
					</div>
					<div class="col-md-10 col-md-10 col-md-10">
						<table class="tt_tb">
						<thead><tr class="tt_tr">
						  <th></th>
						  <th>Title</th>
						  <th>Type</th>
						  <th>Description</th>
						  <th>Cost_(Kshs)</th>
						  <th>Item_Actions</th>
						  <th></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach( $results as $row ) { ?>
						<tr >
							<td><img src="as_media/posts/<?php echo $row['room_image'] ?>" height="50" width="50"/></td>
							<td><?php echo $row['room_title'] ?></td>
							<td><?php echo $row['room_type'] ?></td>
							<td><?php echo $row['room_content'] ?></td>
							<td><?php echo $row['room_cost'] ?></td>
							<td>
								<a href="index.php?page=room_edit&amp;as_roomid=<?php echo $row['roomid'] ?>">Edit</a> 
								| <a href="index.php?page=room_view&amp;as_roomid=<?php echo $row['roomid'] ?>">View</a>
							</td>
							<td></td>
						</tr>
							<?php } ?>
						  </tbody>
						</table>
					</div>
					<div class="col-md-1 col-md-1 col-md-1">
						<div class="contact-social">
							
						</div>
					</div>
			</div>			
		</div>
	</section>
<?php include AS_THEME."as_footer.php" ?>