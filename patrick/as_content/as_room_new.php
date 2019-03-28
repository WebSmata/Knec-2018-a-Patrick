<?php include AS_THEME."as_header.php"; ?>
	<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-4 col-md-6 col-sm-6"><h2 class="tm-section-title">New Room</h2></div>
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>	
				</div>				
			</div>
			<div class="row">
				<!-- contact form -->
				<div class="tm-contact-form">
					<div class="col-lg-3 col-md-3 tm-contact-form-input">
						<div class="contact-social">
							
						</div>
					</div>
					<div class="col-lg-6 col-md-6 tm-contact-form-input">
						<form action="index.php?page=room_new" method="post" enctype="multipart/form-data" >
							<div class="form-group">
								<label>Room Type</label>
								 <select class="form-control" name="room_type" required>
									<option value=""> Select Room </option>
									<option value="single"> Single Room </option>
									<option value="double"> Double Room </option>
									<option value="tripple"> Tripple Room </option>
									<option value="quad"> Quad Room </option>
									<option value="queens"> Queens Room </option>
									<option value="kings"> Kings Room </option>
								</select> 
							</div>
							<div class="form-group">
								<label>Room Title</label>
								<input type="text" autocomplete="off" name="room_title" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Room Cost</label>
								<input type="number" autocomplete="off" name="room_cost" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Room Image</label>
								<input type="file" accept="image/*" name="room_image" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Room Description</label>
								<textarea id="contact_message" class="form-control" rows="6" name="room_content" ></textarea>
							</div>
							<input type="submit" class="tm-submit-btn" name="AddItem" value="Save and Add Another" /><br><br>
							<input type="submit" class="tm-submit-btn" name="AddClose" value="Save and Close" />
						</form>
					</div>
					<div class="col-lg-3 col-md-3 tm-contact-form-input">
						<div class="contact-social">
							
						</div>
					</div>
			</div>			
		</div>
	</section>
<?php include AS_THEME."as_footer.php" ?>