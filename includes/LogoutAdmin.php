<?php
class LogoutAdmin extends Admin{
	var $noLoginRedirect = true;
	public function beforeFilter(){
		
	}
	public function getIndex(){
		global $locale;
		session_destroy();
		setFlash($locale['admin_logout_success']);
		
		return render('admin/login');
	}
	
}
?>