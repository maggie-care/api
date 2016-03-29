<?php namespace mcare;

class User {
	
	//@var int
	protected $user_id;
	
	//@var string
	protected $name;
	
	//@var string
	protected $phone;
	
	//@var string
	protected $api_key;

	
	
	public function get_user_id(){ return $this->user_id; }
	public function get_name(){ return $this->name; }
	public function get_phone(){ return $this->phone;}

	/**
	 * Create user
	 * @return bool True if sucess
	 */
	public function create_user( $acct_id , $api_key , $settings ){
		
		$this->name = ( empty( $settings['name'] ) ) ? '' : $settings['name'];
		
		$this->phone = ( empty( $settings['phone'] ) ) ? '' : $settings['phone'];
		
		$this->role_id = ( empty( $settings['role'] ) ) ? 3 : $settings['role'];
		
		$this->api_key = md5(microtime().rand());
		
		require_once 'authorize.class.php';
		
		require_once 'connect.class.php';
		
		$authorize = new Authorize();
		
		$dbconn = new Connect();
		
		$mysqli = $dbconn->connect('api');
		
		if ( $authorize->check_acct_key( $mysqli , $acct_id , $api_key ) ){
			
			$sql = "INSERT INTO maggiecare_users (user_name,phone,api_key,date_added) VALUES ('$this->name','$this->phone','$this->api_key',now())";
			
			if ( $mysqli->query( $sql ) === TRUE ) {
				
				$this->user_id = $mysqli->insert_id;
				
				$sql = "INSERT INTO maggiecare_acct_users (user_id,acct_id,role_id) VALUES ('$this->user_id','$acct_id','$this->role_id')";
				
				if ( $mysqli->query( $sql ) === TRUE ) {
					
					return true;
					
				} else {
					
					return false;
					
				}
				
			} else {
				
				return false;
				
			}// end if
			
		} else {
			
			echo 'Invalid Request';
			
			$mysqli->close();
			
			die();
			
		}// end if
		
		/*if ( $authorize->check_api_key( $_POST['api_key'] ) ){
			
			require_once 'connect.class.php';
			
			$dbconn = new Connect();
			
			$mysqli = $dbconn->connect('api');
			
			$this->api_key = md5(microtime().rand());
		
			$this->salt = uniqid( mt_rand() , true );
			
			$sql = "INSERT INTO maggiecare_acct (api_key,salt,open) VALUES ('$this->api_key','$this->salt',now())";
			
			if ( $mysqli->query( $sql ) === TRUE ) {
				
				$this->id = $mysqli->insert_id;
				
			} else {
				
				$this->id = false;
				
			} // end if
			
			$mysqli->close();
			
		} else {
			
			echo 'Sorry - Invalid Request';
			
			die();
			
		}// end if*/
		
	} // end create_user
	
} // end User

