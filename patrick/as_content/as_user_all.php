<?php include AS_THEME."as_header.php";
	$myaccount = isset( $_SESSION['site_account'] ) ? $_SESSION['site_account'] : "";
	$database = new As_Dbconn();			
	$as_db_query = "SELECT * FROM as_user ORDER BY userid DESC LIMIT 20";
	$results = $database->get_results( $as_db_query );
?>
  <div class="inner">
    <div class="main">
      <section id="content">        
        <div class="padding-2">
          <div class="indent-top">
            <div class="wrapper">
              <article class="col-3">
                <h4><strong><?php echo $database->as_num_rows( $as_db_query ) ?> Employees</strong>
				<em><a style="float:right;text-align:center;" href="index.php?page=user_new">New Employee</a></em></h4><hr>
				<table class="tt_tb">
				<thead><tr class="tt_tr">
				  <th>Full Name</th>
				  <th>Group</th>
				  <th>Mobile</th>
				  <th>Email</th>
				  <th>Registered</th>
				</tr></thead>
				<tbody>
                <?php foreach( $results as $row ) { ?>
		        <tr onclick="location='index.php?page=user_view&amp;as_userid=<?php echo $row['userid'] ?>'">
				   <td><?php echo $row['user_fname'].' '.$row['user_surname'] ?></td>
		          <td><?php echo $row['user_group'] ?></td>
		          <td><?php echo $row['user_mobile'] ?></td>
		          <td><?php echo $row['user_email'] ?></td>
				  <td><?php echo date("j/m/y", strtotime($row['user_joined'])); ?></td>
		        </tr>
			
			<?php } ?>
			
                      </tbody>
                    </table>
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