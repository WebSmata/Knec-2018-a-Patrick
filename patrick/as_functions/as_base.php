<?php
/*
	AppSmata by Jackson Siro
	http://www.github.com/jacksiro

	File: as_functions/as_base.php
	Description: Sets up AppSmata environment, plus many globally useful functions

*/

	define('AS_VERSION', '0.1.5'); // also used as suffix for .js and .css requests
	define('AS_BUILD_DATE', '2016-11-01');
   
	// SITE FUNCTIONS 
	// Begin General Functions 
	
	function as_path($request, $params=null, $rooturl=null, $neaturls=null, $anchor=null)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }

		if (!isset($neaturls)) {
			require_once AS_INCLUDE_DIR.'app/options.php';
			$neaturls=as_opt('neat_urls');
		}

		if (!isset($rooturl))
			$rooturl=as_path_to_root();

		$url=$rooturl.( (empty($rooturl) || (substr($rooturl, -1)=='/') ) ? '' : '/');
		$paramsextra='';

		$requestparts=explode('/', $request);
		$pathmap=as_get_request_map();

		if (isset($pathmap[$requestparts[0]])) {
			$newpart=$pathmap[$requestparts[0]];

			if (strlen($newpart))
				$requestparts[0]=$newpart;
			elseif (count($requestparts)==1)
				array_shift($requestparts);
		}

		foreach ($requestparts as $index => $requestpart)
			$requestparts[$index]=urlencode($requestpart);
		$requestpath=implode('/', $requestparts);

		switch ($neaturls) {
			case AS_URL_FORMAT_INDEX:
				if (!empty($request))
					$url.='index.php/'.$requestpath;
				break;

			case AS_URL_FORMAT_NEAT:
				$url.=$requestpath;
				break;

			case AS_URL_FORMAT_PARAM:
				if (!empty($request))
					$paramsextra='?js='.$requestpath;
				break;

			default:
				$url.='index.php';

			case AS_URL_FORMAT_PARAMS:
				if (!empty($request))
					foreach ($requestparts as $partindex => $requestpart)
						$paramsextra.=(strlen($paramsextra) ? '&' : '?').'js'.($partindex ? ('_'.$partindex) : '').'='.$requestpart;
				break;
		}

		if (isset($params))
			foreach ($params as $key => $value)
				$paramsextra.=(strlen($paramsextra) ? '&' : '?').urlencode($key).'='.urlencode((string)$value);

		return $url.$paramsextra.( empty($anchor) ? '' : '#'.urlencode($anchor) );
	}
	
	function as_db_error(){
		$as_err['errno'] = 1;
		$as_err['errtype'] = 'database';
		$as_err['errtitle'] = 'Start Setting Up Things';
		$as_err['errsumm'] = 'Set a few options to start you off... on: '.AS_SITEURL;
		require_once 'as_install.php';
	}
	
	function as_db_connect() {
        //error_reporting(0);
		$connect = @mysqli_connect(AS_HOST, AS_USER, AS_PASS, AS_DB);
		if (mysqli_connect_errno())
		{	//echo "Failed to connect to MySQL: ";// . mysqli_connect_error();
			$as_err['errno'] = 1;
			$as_err['errtype'] = 'database';
			$as_err['errtitle'] = 'Start Setting Up Things';
			$as_err['errsumm'] = 'Unable to connect to the database: '.AS_SITEURL;
			require_once 'as_install.php';
			exit();
		}
    }
	
	function as_check_admin() {
		if (!as_check_db_value('userid', 'user_level', 5, 'as_users'))  {
			$as_err = array();
			$as_err['errno'] = 2;
			$as_err['errtype'] = 'user';
			$as_err['errtitle'] = 'Create a Super Admin';
			$as_err['errsumm'] = 'There are no users yet! That means you need to set up a Super-Admin first...';
			require_once 'as_install.php';
			exit(); 
		}
	}
	
	function as_check_options() {
		if (!as_check_db_value('optionid', 'option_title', 'as_sitename', 'as_site_options'))  {
			as_new_option('as_sitename', AS_SITENAME, 1);
			as_new_option('as_siteurl', AS_SITEURL, 1);
		}
	}
		
	function as_set_config($saved_vl, $defaut_vl){
		if (as_get_option($saved_vl)) 
			return as_get_option($saved_vl);
		else return $defaut_vl;
	}
	
	as_initialize_constants_1();	
	as_db_connect();
	
	require_once AS_FUNC.'as_dbconn.php';	
	require_once AS_FUNC.'as_dbcheck.php';	
	require_once AS_FUNC.'as_options.php';
	require_once AS_FUNC.'as_paging.php';
	as_check_options();
	as_check_admin();
	
	as_initialize_constants_2();
	
	function as_initialize_constants_2()
	{
		define('as_siteUrl', as_set_config('as_siteurl', AS_SITEURL));
		define('as_siteTitle', as_get_option('as_sitename'));
		define('as_adminUrl', as_siteUrl.'admin'.as_urlExt);
	}
	
	function as_initialize_constants_1()
	{

		@define('AS_COOKIE_DOMAIN', '');
		@define('AS_HTML_COMPRESSION', true);
		@define('AS_MAX_LIMIT_START', 19999);
		@define('AS_IGNORED_WORDS_FREQ', 10000);
		@define('AS_ALLOW_UNINDEXED_QUERIES', false);
		@define('AS_OPTIMIZE_LOCAL_DB', false);
		@define('AS_OPTIMIZE_DISTANT_DB', false);
		@define('AS_PERSISTENT_CONN_DB', false);
		@define('AS_DEBUG_PERFORMANCE', false);

		define('AS_URL_FORMAT_INDEX', 0);  // http://...../index.html/123/why-is-the-sky-blue
		define('AS_URL_FORMAT_NEAT', 1);   // http://...../123/why-is-the-sky-blue [requires .htaccess]
		define('AS_URL_FORMAT_PARAM', 3);  // http://...../?js=123/why-is-the-sky-blue
		define('AS_URL_FORMAT_PARAMS', 4); // http://...../?js=123&as_1=why-is-the-sky-blue
		define('AS_URL_FORMAT_SAFEST', 5); // http://...../index.html?js=123&as_1=why-is-the-sky-blue

		define('AS_URL_TEST_STRING', '$&-_~#%\\@^*()][`\';=:|".{},!<>?# π§½Жש'); // tests escaping, spaces, song slashing and unicode - but not + and /
	}
	
	function as_redirect($request, $params=null, $rooturl=null, $neaturls=null, $anchor=null)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }
		as_redirect_raw(as_path($request, $params, $rooturl, $neaturls, $anchor));
	}


	function as_redirect_raw($url)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }
		header('Location: '.$url);
		as_exit('redirect');
	}

	function as_gpc_to_string($string)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }

		return get_magic_quotes_gpc() ? stripslashes($string) : $string;
	}


	function as_string_to_gpc($string)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }

		return get_magic_quotes_gpc() ? addslashes($string) : $string;
	}


	function as_get($field)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }

		return isset($_GET[$field]) ? as_gpc_to_string($_GET[$field]) : null;
	}
	
	function as_to_override($function)
	{
		global $as_overrides, $as_direct;

		if (strpos($function, '_override_')!==false)
			as_fatal_error('Override functions should not be calling as_to_override()!');

		if (isset($as_overrides[$function])) {
			if (@$as_direct[$function])
				unset($as_direct[$function]); // bypass the override just this once
			else
				return $as_overrides[$function];
		}

		return null;
	}
	
	function as_call($function, $args)
	{
		switch (count($args)) {
			case 0:
				return $function();
			case 1:
				return $function($args[0]);
			case 2:
				return $function($args[0], $args[1]);
			case 3:
				return $function($args[0], $args[1], $args[2]);
			case 4:
				return $function($args[0], $args[1], $args[2], $args[3]);
			case 5:
				return $function($args[0], $args[1], $args[2], $args[3], $args[4]);
		}

		return call_user_func_array($function, $args);
	}
	
	function as_fatal_error($message)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }
		echo 'AppSmata fatal error:<p><font color="red">'.as_html($message, true).'</font></p>';
		@error_log('PHP AppSmata fatal error: '.$message);
		echo '<p>Stack trace:<p>';

		$backtrace=array_reverse(array_slice(debug_backtrace(), 1));
		foreach ($backtrace as $trace)
			echo '<font color="#'.((strpos(@$trace['file'], '/as_plugin/')!==false) ? 'f00' : '999').'">'.
				as_html(@$trace['function'].'() in '.basename(@$trace['file']).':'.@$trace['line']).'</font><br>';

		as_exit('error');
	}
	
	function as_exit($reason=null)
	{
		//as_report_process_stage('shutdown', $reason);
		exit;
	}
	function as_call_override($function, $args)
	{
		global $as_overrides;

		if (strpos($function, '_override_')!==false)
			as_fatal_error('Override functions should not be calling as_call_override()!');

		if (!function_exists($function.'_base')) // define the base function the first time that it's needed
			eval('function '.$function.'_base() { global $as_direct; $as_direct[\''.$function.'\']=true; $args=func_get_args(); return as_call(\''.$function.'\', $args); }');

		return as_call($as_overrides[$function], $args);
	}


	function as_baseUrl() {
	  	return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
	
	function as_mainUrl() {
	  	if (as_get_option('siteurl') == "") $siteurl = AS_SITEURL;
		else $siteurl = as_get_option('siteurl');
	    return $siteurl;
	}
	
	function as_base_url() {
		/* First we need to get the protocol the website is using */
		$protocol = isset($_SERVER['HTTPS'] ) ? 'https://' : 'http://';
		$root = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT']);
		if(substr($root, -1) == '/')$root = substr($root, 0, -1);
		$base = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, rtrim(AS_BASE, '/'));
		$base = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, AS_BASE);

			
		/* Returns localhost OR mysite.com */
		$host = $_SERVER['HTTP_HOST'];
		$url = $protocol . rtrim($host, '/') . '/' . str_replace($root, '', $base );
		
		return (substr($url, -1) == '/') ? substr($url, 0, -1) : $url;
	}	
	
	function as_set_request($request, $relativeroot, $usedformat=null)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }

		global $as_request, $as_root_url_relative, $as_used_url_format;

		$as_request=$request;
		$as_root_url_relative=$relativeroot;
		$as_used_url_format=$usedformat;
	}
	
	function as_get_request_map()
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }
		global $as_request_map;
		return $as_request_map;
	}
	
	function as_request()
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }

		global $as_request;
		return $as_request;
	}


	function as_request_part($part)
	{
		$parts=explode('/', as_request());
		return @$parts[$part];
	}


	function as_request_parts($start=0)
	{
		return array_slice(explode('/', as_request()), $start);
	}
	
	function as_urlext()
	{
		return as_urlExt;
	}
	
	function as_siteUrl(){
        if (as_get_option('adminurl') == "") $siteurl = AS_SITEURL;
		else $siteurl = as_get_option('adminurl');
	    return $siteurl;
	}

    function as_check_db_value($value_id, $value_title, $value_value, $value_table){
		$database = new As_Dbconn();
		$check_column = $value_id;
		$check_for = array( $value_title => $value_value );
		$exists = $database->exists( $value_table, $check_column,  $check_for );
		if( $exists ){ return true; }
    }
	
    function as_check_db_item($table_name){
		$database = new As_Dbconn();
		$exists = $database->as_num_rows("SELECT * FROM $table_name");
        //$exists = $database->exists( $value_table);
		if( $exists ){ return true; }
    }
	
	function as_html($string, $multiline=false)
	{
		$html=htmlspecialchars((string)$string);
		if ($multiline){
			$html=preg_replace('/\r\n?/', "\n", $html);
			$html=preg_replace('/(?<=\s) /', '&nbsp;', $html);
			$html=preg_replace('\t', '&nbsp; &nbsp; ', $html);
			$html=nl2br($html);
		}
		return $html;
	}
	
	function as_clicked($name)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }
		return isset($_POST[$name]) || isset($_POST[$name.'_x']) || (as_post_text('as_click')==$name);
	}
	
	function as_post_text($field)
	{
		if (as_to_override(__FUNCTION__)) { $args=func_get_args(); return as_call_override(__FUNCTION__, $args); }
		return isset($_POST[$field]) ? preg_replace('/\r\n?/', "\n", trim(as_gpc_to_string($_POST[$field]))) : null;
	}

	function as_get_option($option) {
		$as_db_query = "SELECT * FROM as_site_options WHERE option_title = '$option'";
		$database = new As_Dbconn();
		if( $database->as_num_rows( $as_db_query ) > 0 ) {
            list( $optionid, $option_title, $option_content) = $database->get_row( $as_db_query );
		    return $option_content;
		} else  {
		    return false;
		}
		
	}
	
	function as_site_theme($section){
		return AS_CONT."/".$section;
	}
	
	function as_new_option($title, $content, $userid) {
		$database = new As_Dbconn();			
		$New_Option_Details = array(
			'option_title' => $title,
			'option_content' => $content,
			'option_createdby' => $userid,
			'option_created' => date('Y-m-d H:i:s'),
		);
		$add_query = $database->as_insert( 'as_site_options', $New_Option_Details ); 			
	}
	
	function as_set_option($title, $content, $userid) {
		$database = new As_Dbconn();	
		$as_db_query = "SELECT * FROM as_site_options WHERE option_title = '$title'";		
		if( $database->as_num_rows( $as_db_query ) ==1 ) {
			$Update_Option = array(
				'option_title' => trim($title),
				'option_content' => trim($content),
				'option_updated' => date('Y-m-d H:i:s'),
				'option_updatedby' => $userid,
			);
			$where_clause = array('option_title' => $title);
			$updated = $database->as_update( 'as_site_options', $Update_Option, $where_clause, 1 );
		} else  {
            as_new_option($title, $content, $userid);
        }		
	}
		
	function as_reset_option($title, $content, $userid) {
		$database = new As_Dbconn();	
		$as_check = $database->as_num_rows("SELECT * FROM as_site_options WHERE option_title = '$title'");
        if( $as_check ) {
            $Update_Option_Details = array(
				'option_title' => trim($title),
				'option_content' => trim($content),
				'option_updated' => date('Y-m-d H:i:s'),
				'option_updatedby' => $userid,
			);
			$where_clause = array('option_title' => $title);
			$updated = $database->as_update( 'as_site_options', $Update_Option_Details, $where_clause, 1 );
        }  else  {
            as_new_option($title, $content, $userid);
        }		
	}

	function as_str_slag($string) {
		$string = preg_replace("/[^A-Za-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", "_", $string);	
		$string = strtolower($string);			
		return $string;
	}
	