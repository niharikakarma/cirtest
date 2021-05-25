<?php
// Holds the Google application Client Id, Client Secret and Redirect Url
require_once('settings.php');

// Holds the various APIs functions
require_once('google-calendar-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		// Get the access token 
		$capi = new GoogleCalendarApi();
		// Get the access token 
		$data = $capi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		echo "<pre>";print_r($data);
		$access_token = $data['access_token'];
		
		// Get user calendar timezone
		//$user_timezone = $capi->GetUserCalendarTimezone($access_token);
		
		$list = $capi->GetCalendarsList($access_token);
		echo "<pre>";print_r($list);
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>