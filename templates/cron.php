<?php
/*
Developer: Sk Md Imtiaj
Website: https://www.boysofts.com/
Email: info@boysofts.com
*/

require_once('settings.php');

set_time_limit(0);

$cron_file_name = 'cron';

$corn_time_diff = @(time()-filemtime($cron_file_name));


if($corn_time_diff >=$cron_frequency || !empty($_GET['forced']) || !file_exists($cron_file_name) ){
	//do corn job
	echo '/*corn*/';
	$self_url = selfURL();
	$ref = str_ireplace('cron.php', '', $self_url);
	if( in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ) ) ){
	   $url = 'http://localhost:8080/api/v1/dump/'; //only for my local testing.
	}else{
	    $url = "$base_api_dump_url?site_admin_email=$site_admin_email&site_url=$ref";
	}
	
    
	
	//$url = "$url?ref=$ref";
	$json_data = fetch_url($url, $ref, $user_agent=false);
    $json_data  = json_decode($json_data, True);
	DB::insertIgnore('torrents', $json_data);
	touch($cron_file_name);
}