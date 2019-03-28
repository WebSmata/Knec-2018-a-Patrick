<?php include AS_THEME."as_header.php"; ?>
<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Sign in to your Account</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
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
						<form action="index.php?page=login" method="post">
							<div class="form-group">
								<label>Your Username:</label>
								<input type="text" autocomplete="off" name="loginname" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Your Password:</label>
								<input type="password" autocomplete="off" name="loginkey" class="form-control" required>
							</div><br><br>
							<input type="submit" class="tm-submit-btn" name="SignMeIn" value="Sign In" />
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