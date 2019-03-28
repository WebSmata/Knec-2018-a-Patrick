<?php include AS_THEME."as_header.php"; 
	$database = new As_Dbconn();
	
	$room_qry = "SELECT * FROM as_room ORDER BY roomid  ASC LIMIT 2";
	$results = $database->get_results( $room_qry );
	
?>
<section class="tm-banner">
		<!-- Flexslider -->
		<div class="flexslider flexslider-banner">
		  <ul class="slides">
		    <li>
			    <div class="tm-banner-inner">
					<h1 class="tm-banner-title">Sleep <span class="tm-yellow-text">Like a</span> King</h1>
					<p class="tm-banner-subtitle">For Your Comfort</p>
					<a href="#more" class="tm-banner-link">Learn More</a>	
				</div>
				<img src="as_media/slider/banner-1.jpg" alt="Image" />	
		    </li>
		    <li>
			    <div class="tm-banner-inner">
					<h1 class="tm-banner-title">Get <span class="tm-yellow-text">The Best</span> Package</h1>
					<p class="tm-banner-subtitle">Customised for you</p>
					<a href="#more" class="tm-banner-link">Learn More</a>	
				</div>
		      <img src="as_media/slider/banner-2.jpg" alt="Image" />
		    </li>
		    <li>
			    <div class="tm-banner-inner">
					<h1 class="tm-banner-title">Just <span class="tm-yellow-text">The Best</span> For you</h1>
					<p class="tm-banner-subtitle">Get treated like a King</p>
					<a href="#more" class="tm-banner-link">Learn More</a>	
				</div>
		      <img src="as_media/slider/banner-3.jpg" alt="Image" />
		    </li>
		  </ul>
		</div>	
	</section>

	<!-- gray bg -->	
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6">
				<!-- Nav tabs -->
				<div class="tm-home-box-1">
					<ul class="nav nav-tabs tm-white-bg" role="tablist" id="roomCarTabs">
					    <li role="presentation" class="active">
					    	<a href="#room" aria-controls="room" role="tab" data-toggle="tab">Book a Room!</a>
					    </li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
					    <div role="tabpanel" class="tab-pane fade in active tm-white-bg" id="room">
					    	<div class="tm-search-box effect2">
								<form action="index.php" method="post" class="room-search-form">
									<div class="tm-form-inner">
										<div class="form-group">
							            	 <select class="form-control" name="roomtype" required>
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
							                <div class='input-group date' id='datetimepicker1'>
							                    <input type='text' name="datein" class="form-control" placeholder="Check-in Date" required/>
							                    <span class="input-group-addon">
							                        <span class="fa fa-calendar"></span>
							                    </span>
							                </div>
							            </div>
							          	<div class="form-group">
							                <div class='input-group date' id='datetimepicker2'>
							                    <input type='text' name="dateout" class="form-control" placeholder="Check-out Date"  required/>
							                    <span class="input-group-addon">
							                        <span class="fa fa-calendar"></span>
							                    </span>
							                </div>
							            </div>
										<br><br>
									</div>							
						            <div class="form-group tm-yellow-gradient-bg text-center">
										<input type="submit" name="CheckNowRoom" class="tm-yellow-btn" value="Check Now" />
						            </div>  
								</form>
							</div>
					    </div>
					    			    
					</div>
				</div>								
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-home-box-1 tm-home-box-1-2 tm-home-box-1-center">
					<img src="as_media/posts/single.jpg" alt="image" class="img-responsive" style="width:340px;height:260px;">
					<a href="#">
						<div class="tm-green-gradient-bg tm-city-price-container">
							<span>Single</span>
						</div>	
					</a>			
				</div>				
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-home-box-1 tm-home-box-1-2 tm-home-box-1-center">
					<img src="as_media/posts/double.jpg" alt="image" class="img-responsive" style="width:340px;height:260px;">
					<a href="#">
						<div class="tm-green-gradient-bg tm-city-price-container">
							<span>Double</span>
						</div>	
					</a>			
				</div>				
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-home-box-1 tm-home-box-1-2 tm-home-box-1-center">
					<img src="as_media/posts/tripple.png" alt="image" class="img-responsive" style="width:340px;height:260px;">
					<a href="#">
						<div class="tm-green-gradient-bg tm-city-price-container">
							<span>Tripple</span>
						</div>	
					</a>			
				</div>				
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-home-box-1 tm-home-box-1-2 tm-home-box-1-center">
					<img src="as_media/posts/quad.jpg" alt="image" class="img-responsive" style="width:340px;height:260px;">
					<a href="#">
						<div class="tm-green-gradient-bg tm-city-price-container">
							<span>Quad</span>
						</div>	
					</a>			
				</div>				
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-home-box-1 tm-home-box-1-2 tm-home-box-1-center">
					<img src="as_media/posts/casual.jpg" alt="image" class="img-responsive" style="width:340px;height:260px;">
					<a href="#">
						<div class="tm-green-gradient-bg tm-city-price-container">
							<span>Casual</span>
						</div>	
					</a>			
				</div>				
			</div>
		</div>
	</section>		
	
<?php include AS_THEME."as_footer.php" ?>