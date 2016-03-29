<?php namespace mcare;

require_once dirname( dirname( dirname( __FILE__ ) ) ) . '/classes/user.class.php';

class User_Create {
		
	// @var object
	private $user;
	
	public function __construct(){
		
		$user_info = array();
		
		$this->user = new User();
		
		$settings = array();
		
		$settings['name'] = ( ! empty( $_POST['name'] ) )? $_POST['name'] : '';
		
		$settings['phone'] = ( ! empty( $_POST['phone'] ) )? $_POST['phone'] : '';
		
		$acct_id = ( ! empty( $_POST['acct_id'] ) )? $_POST['acct_id'] : '';
		
		$api_key = ( ! empty( $_POST['api_key'] ) )? $_POST['api_key'] : '';
		
		$this->user->create_user( $acct_id , $api_key , $settings );
		
		if ( $this->user->get_user_id() ){
		
			$user_info['user_id'] = $this->user->get_user_id();
			
			$user_info['name'] = $this->user->get_name();
			
			$user_info['phone'] = $this->user->get_phone();
		
		} // end if
		
		/*$this->account->create_account( $_POST['api_key'] , $_POST['name'] );
		
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
		
		} // end if*/
		
		echo json_encode( $user_info );
		
	} // end __construct
	
}
$user_create = new User_Create();