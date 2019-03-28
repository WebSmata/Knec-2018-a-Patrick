<?php
$success = '';
$errorhtml = '';
$suggest = '';
$buttons = array();
$fields = array();
$hidden = array();

	require_once AS_FUNC.'as_users.php';
	if (as_clicked('DatabaseSetup')) {
		$sitename = as_post_text('sitename');
		$database = as_post_text('database');
		$username = as_post_text('username');
		$password = as_post_text('password');
				
		$filename = "as_config.php";
		$lines = file($filename, FILE_IGNORE_NEW_LINES );
		$lines[14] = '	define( "AS_DB", "'.$database.'" );';
		$lines[15] = '	define( "AS_USER", "'.$username.'" );';
		$lines[16] = '	define( "AS_PASS", "'.$password.'"  );';
		$lines[20] = '	define( "AS_SITENAME", "'.$sitename.'"  );';
		file_put_contents($filename, implode("\n", $lines));
		header("location: ".AS_SITEURL);
	}
	else if (as_clicked('SuperAdmin')) {
		$firstname = as_post_text('firstname');
		$surname = as_post_text('surname');
		$username = as_post_text('username');
		$email = as_post_text('email');
		$password = as_post_text('password');
		
		$database = new As_Dbconn();
		$New_Item_Details = array(
			'user_name' => $username,
			'user_fname' => $firstname,
			'user_lname' => $surname,
			'user_password' => md5($password),
			'user_email' => $email,
			'user_group' => 1,
			'user_level' => 5,
			'user_joined' => date('Y-m-d H:i:s'),
		);		
		$add_query = $database->as_insert( 'as_users', $New_Item_Details );
		
		header("location: ".AS_SITEURL);

	}
		
	?>
<!DOCTYPE html>
<html>
	<head>
		<title>Checkout AppSmata</title>
		<style>
			body { font-family: arial,sans-serif; font-size:0px;margin: 50px 10px;	padding: 0; text-align: center;background: #EEE; color: darkgreen;	} h1{font-size:30px;} input[type="text"],input[type="email"],input[type="password"],textarea{font-size:20px;padding:5px;width:100%; color:#000; border:1px solid #999; border-radius: 5px; background:#EEE;} table{width:80%;margin:10px;text-align: left;} input[type="submit"]{background:#B00; color:#FFF; padding:10px 20px; border:1px solid #FFF; font-size:25px; border-radius: 5px; } img { border: 0; } .rounded {	-webkit-border-radius: 12px;	-moz-border-radius: 12px; border-radius: 12px;} .rounded_i {	-webkit-border-radius: 10px 10px 0px 0px;	-moz-border-radius: 10px 10px 0px 0px; border-radius: 10px 10px 0px 0px;} .rounded_ii { border: 1px solid #F00; margin-top:10px; padding:20px; -webkit-border-radius: 0px 0px 10px 10px;	-moz-border-radius: 0px 0px 10px 10px; border-radius: 0px 0px 10px 10px;} #content { margin: 0 auto;	width: 800px; } .title-section { background-color: #FF0000;	border: 1px solid #EEE; color: #fff; font-weight: bold; padding: 12px ;}#debug { margin-top: 50px; text-align:left;	}.main-section { border: 1px solid #B00; background:#FFF; margin: 5px;padding:10px;  font-size:20px;} .mid-section { border: 1px solid #F00; background:#FFF; margin-top: 10px; font-size:20px;}
		</style>
	</head>
	<body>
		<div id="content">
		  <div class="main-section rounded">
			<div class="title-section rounded_i">	
				<h1><?php echo $as_err['errtitle'] ?></h1>
			</div>
			<div class="mid-section">	
				<p><?php echo $as_err['errsumm'] ?></p>
			</div>	
			<form method="post" action="<?php //echo AS_SITEURL ?>" class="rounded_ii">						
<?php 
		if ($as_err['errno']==1){ 
			$fields = array(
				'sitename' => array('label' => 'System Name:', 'type' => 'text', 'value' => AS_SITENAME),
				'database' => array('label' => 'Database Name:', 'type' => 'text', 'value' => AS_DB),
				'username' => array('label' => 'Database Username:', 'type' => 'text', 'value' => AS_USER),
				'password' => array('label' => 'Database Password:', 'type' => 'password', 'value' => ''),
				
			);
			$buttons = array('DatabaseSetup' => 'Connect to the Database');
		} 
		else if ($as_err['errno']==2){ 
			$fields = array(
				'firstname' => array('label' => 'First Name:', 'type' => 'text', 'value' => ''),
				'surname' => array('label' => 'Last Name:', 'type' => 'text', 'value' => ''),
				'username' => array('label' => 'Username:', 'type' => 'text', 'value' => ''),
				'email' => array('label' => 'Email Address:', 'type' => 'email', 'value' => ''),
				'password' => array('label' => 'Password:', 'type' => 'password', 'value' => ''),
			);
			$buttons = array('SuperAdmin' => 'Create An Administrator');
		} 
		?>
	<?php if (count($fields)) { ?>
			<table>
	<?php foreach($fields as $name => $field) { ?>
				<tr>	
						<th><?php echo as_html($field['label']) ?></th>	
						<td><?php echo'<input type="'.as_html($field['type']).'" size="24" name="'.as_html($name).'" value="'.as_html($field['value']).'" autocomplete="off" />'; ?></td>
		<?php if (isset($fielderrors[$name])) 
			echo '<td class="msg-error"><small>'.as_html($fielderrors[$name]).'<small></td>';
		else ?>
				<td></td>
					</tr>			
	<?php } ?>
			</table>
				<?php } 
		foreach ($buttons as $name => $value)
			echo '<input type="submit" name="'.as_html($name).'" value="'.as_html($value).'" />';
		foreach ($hidden as $name => $value)
			echo '<input type="hidden" name="'.as_html($name).'" value="'.as_html($value).'" />';
	?>	
<?php ?>
			</form>
		  </div>
		</div>
	</body>
</html>	