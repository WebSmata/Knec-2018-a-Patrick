<?php include AS_THEME."as_header.php";
	$myaccount = isset( $_SESSION['site_account'] ) ? $_SESSION['site_account'] : "";
	?>
  <div class="inner">
    <div class="main">
      <section id="content">
        
        <div class="padding-2">
          <div class="indent-top">
            <div class="wrapper">
              <article class="col-3">
                <h4><strong>Username</strong> <em>Recovery Center</em></h4>
				
				<hr>
				<p>Username recovery was successful as:</p><br>
				<h2><?php echo $_SESSION['recover_username'] ?></h2><hr>
			<a href="index.php"><h1>>> Now Login In >></h1></a>
      </form>
              </article>
			  <?php include AS_THEME."as_sidebar.php" ?>
              
            </div>
          </div>
        </div>

      </section>
      <div class="block"></div>
    </div>
  </div>
</div>


<?php include AS_THEME."as_footer.php" ?>