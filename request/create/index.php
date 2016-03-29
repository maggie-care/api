<?php namespace mcare;

require_once dirname( dirname( dirname( __FILE__ ) ) ) . '/classes/request.class.php';

class Request_Create {
	
	public function __construct(){
		
		$request = new Request();
		
		
	} // end __construct
	
}
$request_create = new Request_Create();