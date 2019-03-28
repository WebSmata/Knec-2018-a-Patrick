<?php include AS_THEME."as_header.php"; ?>
<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-4 col-md-3 col-sm-3"><h2 class="tm-section-title">Sign In</h2><hr></div>
					<div class="col-lg-4 col-md-6 col-sm-6"><h2 class="tm-section-title">My Account</h2></div>
					<div class="col-lg-4 col-md-3 col-sm-3"><h2 class="tm-section-title">Sign Up</h2><hr></div>	
				</div>				
			</div>
			<div class="row">
				<!-- contact form -->
				<div class="tm-contact-form">
					<div class="col-lg-6 col-md-6 tm-contact-form-input">
						<form action="index.php?page=login" method="post" >
							<div class="form-group">
								<label>Username:</label>
								<input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
							</div>
							<div class="form-group">
								<label>Password:</label>
								<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
							</div>
							<div class="form-group">
								<button class="tm-submit-btn" type="submit" name="SignIn">Sign In</button> 
							</div>
						</form>
					</div>
					<div class="col-lg-6 col-md-6 tm-contact-form-input">
						<form action="index.php?page=login" method="post" >
							<div class="form-group">
								<input type="text" autocomplete="off" name="fname" class="form-control" placeholder="First Name" required>
							</div>
							<div class="form-group">
								<input type="text" autocomplete="off" name="surname" class="form-control" placeholder="Last Name" required>
							</div>
							<div class="form-group">
								<input type="text" autocomplete="off" name="email" class="form-control" placeholder="Email Address" required />
							</div>
							<div class="form-group">
								<input type="text" autocomplete="off" name="mobile" class="form-control" placeholder="Mobile Phone" required/>
							</div>
							<div class="form-group">
								<input type="text" autocomplete="off" name="username" class="form-control" placeholder="Preferred Username" required/>
							</div>
							<div class="form-group">
								<input type="password" autocomplete="off" name="password" class="form-control" placeholder="Preferred Password" required/>
							</div>
							<input type="submit" class="tm-submit-btn" name="SignUp" value="Sign Up" />
						</form>
					</div>
			</div>			
		</div>
	</section>


<?php include AS_THEME."as_footer.php" ?>