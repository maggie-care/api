<?php namespace mcare;

class Account_Request {
	
	public function __construct(){
		
		require_once dirname( dirname( __FILE__ ) ) . '/classes/authorize.class.php';
		
		$authorize = new Authorize();
		
		if ( $authorize->check_api_key( $_POST['api_key'] ) ){
			
			$this->do_request();
			
		} else {
			
			echo 'Sorry - Invalid Request';
			
		}// end if
		
		
	} // end __construct
	
	private function do_request(){
	}
	
}
$account = new Account_Request();