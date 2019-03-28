<?php include AS_THEME."as_header.php"; ?>
<div class="allcontain"><br>
	<div id="roomousel-up" class="roomousel slide" data-ride="roomousel">
		<?php include AS_THEME."as_bodytop.php"; ?>
	</div>
</div>
<div class="allcontain">
	<div class="contact">
		<div class="newslettercontent">
			<div class="leftside">
				<img id="image_border" src="as_themes/image/formone.png" alt="border">
				<div class="general-form">
					<h1>Register your account</h1> 
					<form role="form" method="post" name="PostUser" action="index.php?page=register" enctype="multipart/form-data" >
						<div class="form-group group-coustume">
							<label>First  Name:</label>
							<input type="text" autocomplete="off" name="fname" class="form-control name-form" />
							<label>Second Name:</label>
							<input type="text" autocomplete="off" name="surname" class="form-control name-form" />
							<label>Upload User Avatar:</label>
							<input name="avatar" autocomplete="off" type="file" accept="image/*" class="form-control name-form" />
							
							<label>Email Address:</label>
							<input type="text" autocomplete="off" name="email" class="form-control name-form" />
							
							<label>Mobile (Optional):</label>
							<input type="text" autocomplete="off" name="mobile" class="form-control name-form" />
							
							<label>Preferred Username:</label>
							<input type="text" autocomplete="off" name="username" class="form-control name-form" />
							
							<label>Preferred Password:</label>
							<input type="password" autocomplete="off" name="password" class="form-control name-form" />
							
							<label>Confirm Password:</label>
							<input type="password" autocomplete="off" name="passwordcon" class="form-control name-form" />
							<input type="submit" id="aalogin-button" class="btn btn-default btn-submit" name="Register" value="Register" />
						</div>
					</form>
				</div>
			</div>
			<div class="google-maps"><div id="googleMap"></div></div>
		</div>
	</div>
</div>
<?php include AS_THEME."as_footer.php" ?>