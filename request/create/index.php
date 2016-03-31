<?php namespace mcare;

require_once dirname( dirname( dirname( __FILE__ ) ) ) . '/classes/request.class.php';

class Request_Create {
	
	public function __construct(){
		
		$request = new Request();
		
		$acct_id = ( ! empty( $_POST['acct_id'] ) )? $_POST['acct_id'] : false; 
		
		$api_key = ( ! empty( $_POST['api_key'] ) )? $_POST['api_key'] : false;
		
		$settings = array();
		
		$request_type_id = 1;
		
		if ( $acct_id &&  $api_key ){
			
			$request->create_request( $request_type_id , $request_settings , $acct_id , $api_key );
			
			echo json_encode( $request->get_request_array() );
			
		} else {
			
			die('Invalid Request');
			
		}// end if
		
	} // end __construct
	
}
$request_create = new Request_Create();