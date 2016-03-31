<?php namespace mcare;
/**
 * Abstract class for Authorizing API access\
 * @author Danial Bleile
 * @version 0.0.1
 */

require_once 'connect.class.php';
 
class Authorize extends Connect{
	
	//@var
	private $api_key = '{TQ$4oYQhLb9Z20-1a0jG;kK8;=3DY';
	
	public function authorize_acct( $acct_id , $api_key ){
		
		if ( $acct_id && $api_key ){
			
			$mysqli = $this->connect('api');
		
			$acct = $this->query_acct( $mysqli , $acct_id );
			
			if ( $api_key == $acct['api_key'] ){
				
				$mysqli->close();
				
				return true;
				
			} else {
				
				$mysqli->close();
				
				die( 'Invalid Request');
				
			}
			
			
		
		} else {
			
			die( 'Invalid Request');
			
		}// end if
		
	} // endn
	
	private function query_acct( $mysqli , $acct_id ){
		
		$sql = "SELECT * FROM maggiecare_acct WHERE id=$acct_id";
		
		$query = $mysqli->query( $sql );
		
		$row = $query->fetch_assoc();
		
		if ( $row ) {
			
			return $row;
			
		} else {
			
			$mysqli->close();
			
			die( 'Invalid Request');
			
		}// end if
		
	}
	
	
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