<?php
class Admin{
	var $noLoginRedirect = false;
	var $db = null;
	function __construct(){
		global $db;
		$this->db = $db;
		
		$this->beforeFilter();
	}
	function __destruct(){
		$this->afterFilter();
	}
	public function beforeFilter(){
		
		if($_SESSION['isAdminLogin']==false && !$this->noLoginRedirect){
			redirect('/admin/login');
		}else{
			if(!$this->validate_session()){
				redirect('/admin/login');
			}
			
		}
	}
	public function afterFilter(){
		
	}
	private function validate_session(){
		$session = getAdminSession();
		$session_token = md5($session['id'].$session['username'].date("YmdH"));
		
		//if token matched, that's mean that the session is still valid
		//at the moment defaults to 1 day
		if($session['token'] == $session_token){
			return true;	
		}
		
	}
}
?>