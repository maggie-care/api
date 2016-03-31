<?php namespace mcare;

require_once 'authorize.class.php';

require_once 'connect.class.php';

class Request extends Connect{
	
	private $request_id = false;
	
	private $request_type_id = false;
	
	private $request_status = false;
	
	private $created = false;
	
	
	public function get_request_id(){ return $this->request_id; }
	public function get_request_type_id(){ return $this->request_type_id; }
	public function get_request_status(){ return $this->request_status; }
	public function get_created(){ return $this->created; }
	
	public function get_request_array(){
		
		if ( $this->get_request_id() ){
		
			$array = array(
				'request_id' => $this->get_request_id(),
				'request_type_id' => $this->get_request_type_id(),
				'request_status' => $this->get_request_status(),
				'created' => $this->get_created(),
			
			);
			
			return $array;
			
		} else {
			
			return array(); 
			
		}// e
		
	}
	
	public function create_request( $request_type_id , $request_settings ,  $acct_id ,$api_key ){
		
		$authorize = new Authorize();
		
		if ( $authorize->authorize_acct( $acct_id , $api_key ) ){
			
			$mysqli = $this->connect( 'api' );
			
			$request_id = $this->insert_request( $mysqli , $acct_id , $request_type_id );
			
			if ( $request_id ){
				
				$made_request = $this->insert_open_request( $mysqli , $acct_id , $request_id );
				
				if ( $made_request ){
					
					$this->request_id = $request_id;
					
					$this->request_type_id = $request_type_id;
					
					$this->request_status = 1;
					
					$this->created = date('Y/m/d H:i:s');
					
					return true;
					
				} else {
					
					return false;
					
				}
				
			} else {
				
				return false;
				
			}// end if
			
			
		} else {
			
			die('Invalid Request');
			
		}
		
	}
	
	public function get_request( $acct_id, $api_key, $request_id ){
		
		if ( $authorize->authorize_acct( $acct_id , $api_key ) ){
			
			$mysqli = $this->connect();
			
			$request = $this->select_request( $mysqli , $request_id );
			
			if ( $request ){
				
				return json_encode( $request );
				
			} else {
				
				return false;
				
			}// end if
			
		} else {
			
			die('Invalid Request');
			
		} // end if
		
	} // end get_request
	
	private function insert_request( $mysqli, $acct_id , $request_type_id  ){
		
		$sql = "INSERT INTO maggiecare_requests (acct_id,request_type_id,request_status_id,created) VALUES ('$acct_id','$request_type_id',1,now())";
		
		if ( $mysqli->query( $sql ) === TRUE ){
			
			echo 'Request Added';
			
			return $mysqli->insert_id;
			
		} else {
			
			return false;
			
		} // end if
		
	} // end insert_request
	
	private function insert_open_request( $mysqli , $acct_id , $request_id ){
		
		$sql = "INSERT INTO maggiecare_open_requests (request_id,acct_id,created) VALUES ('$request_id','$acct_id',now())";
		
		if ( $mysqli->query( $sql ) === TRUE ){
			
			echo 'Open Request Added';
			
			return true;
			
		} else {
			
			return false;
			
		} // end if
		
	} // end insert_open_request
	
}