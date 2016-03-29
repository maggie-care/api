<?php namespace mcare;

class Account {
	
	//@var int
	protected $acct_id;
	
	//@var string
	protected $api_key;
	
	//@var string
	protected $salt;
	
	
	public function get_acct_id(){ return $this->acct_id; }
	public function get_api_key(){ return $this->api_key; }
	public function get_salt(){ return $this->salt;}
	
	public function get_account_array(){
		$data = array(
			'acct_id' => $this->get_acct_id(),
			'api_key' => $this->get_api_key(),
			'salt'    => $this->get_salt(),
		);
		return $data;
		
	} // end get_user_data

	/**
	 * Create an account
	 * @return array | bool Account Info
	 */
	public function create_account( $api_key , $name ){
		
		require_once 'authorize.class.php';
		
		$authorize = new Authorize();
		
		if ( $authorize->check_api_key( $api_key ) ){
			
			require_once 'connect.class.php';
			
			$dbconn = new Connect();
			
			$mysqli = $dbconn->connect('api');
			
			$this->api_key = md5(microtime().rand());
		
			$this->salt = uniqid( mt_rand() , true );
			
			$sql = "INSERT INTO maggiecare_acct (api_key,salt,open) VALUES ('$this->api_key','$this->salt',now())";
			
			if ( $mysqli->query( $sql ) === TRUE ) {
				
				$this->acct_id = $mysqli->insert_id;
				
			} else {
				
				$this->acct_id = false;
				
			} // end if
			
			$mysqli->close();
			
		} else {
			
			echo 'Sorry - Invalid Request';
			
			die();
			
		}// end if
		
	} // end create_account
	
} // end Account

