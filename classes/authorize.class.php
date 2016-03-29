<?php namespace mcare;
/**
 * Abstract class for Authorizing API access\
 * @author Danial Bleile
 * @version 0.0.1
 */
class Authorize {
	
	//@var
	private $api_key = '{TQ$4oYQhLb9Z20-1a0jG;kK8;=3DY';
	
	
	/**
	 * Checks supplied key against api key
	 * @param string $key Key to test
	 * @return bool True if match
	 */
	public function check_api_key( $key ){
		
		if ( $key == $this->api_key ) {
			
			return true;
			
		} else {
			
			return false;
			
		} // end if
		
	} // end check_api_key
	
	/**
	 * Checks supplied key against account_inf
	 * @param int $acct_id ID of the account
	 * @param string $api_key API Key for the account
	 * @return bool True if match
	 */
	public function check_acct_key( $mysqli, $acct_id , $api_key ){
		
		$sql = "SELECT * FROM maggiecare_acct WHERE id=$acct_id";
		
		$query = $mysqli->query( $sql );
		
		$row = $query->fetch_assoc();
		
		if ( $row ){
			
			if ( $api_key == $row['api_key'] ){
				
				return true;
				
			} else {
				
				return false;
				
			}// end if
			
			
		} else {
			
			return false;
			
		}
		
	} // end check_acct_key
	
	
} // end Authorize