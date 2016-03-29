<?php namespace mcare;

require_once dirname( dirname( dirname( __FILE__ ) ) ) . '/classes/account.class.php';

require_once dirname( dirname( dirname( __FILE__ ) ) ) . '/classes/user.class.php';

class Account_Create {
		
	// @var object
	private $account;
	
	public function __construct(){
		
		$account_info = array();
		
		$this->account = new Account();
		
		$this->account->create_account( $_POST['api_key'] , $_POST['name'] );
		
		if ( $this->account->get_acct_id() ){
			
			$user_settings = array();
			
			$user_settings['name'] = ( empty( $_POST['name'] ) ) ? '' : $_POST['name'];
		
			$user_settings['phone'] = ( empty( $_POST['phone'] ) ) ? '' : $_POST['phone'];
			
			$user_settings['role'] = 1;
			
			$user = new User();
			
			$user->create_user( $this->account->get_acct_id() , $this->account->get_api_key() , $user_settings );
		
			$account_info['acct_id'] = $this->account->get_acct_id();
			
			$account_info['api_key'] = $this->account->get_api_key();
			
			$account_info['salt'] = $this->account->get_salt();
			
			$account_info['user_id'] = $user->get_user_id();
			
			$account_info['user_name'] = $user->get_name();
		
		} // end if
		
		echo json_encode( $account_info );
		
	} // end __construct
	
}
$account_create = new Account_Create();