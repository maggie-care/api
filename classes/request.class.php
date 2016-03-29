<?php namespace mcare;

class Request {
	
	public function create_request( $request_id , $request_settings , $api_key , $acct_id ){
		
		require_once 'authorize.class.php';
		
		require_once 'connect.class.php';
		
		$connect = new Connect();
		
		$authorize = new Authorize();
		
		$mysqli = $connect->connect('api');
		
		if ( $authorize->check_acct_key( $mysqli , $acct_id , $api_key ) ){
			
			
			
		} else {
			
			die('Invalid Request');
			
		}// end if
		
		$mysqli->close();
		
	}
	
	
	
}