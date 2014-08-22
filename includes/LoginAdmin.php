<?php
class LoginAdmin extends Admin{
	var $noLoginRedirect = true;
	public function beforeFilter(){
		
	}
	public function getIndex(){
		
		return render('admin/login');
	}
	public function postIndex(){
		global $locale;

		if(strlen($_POST['username'])>0 && strlen($_POST['password'])>5){
			if($this->validateLogin($_POST['username'],$_POST['password'])){
				redirect('/admin/');
			}else{
				setFlash($locale['admin_login_failed']);
				return render('admin/login');
			}
		}else{

			setFlash($locale['admin_login_failed']);
			return render('admin/login');
		}
		
	}
	private function validateLogin($username,$password){
		$hash = md5($password.md5($username));
		$user = $this->db->query("SELECT * FROM admins WHERE username = ? LIMIT 1",$username);
		if($user[0]['password'] == $hash){
			$this->generateLoginSession($user[0]);
			$this->updateLastLogin($user[0]['id']);
			return true;
		}
	}
	private function generateLoginSession($user){
		$session_token = md5($user['id'].$user['username'].date("YmdH"));
		$_SESSION['session_admin'] = array('token' => $session_token,
											'username'=>$user['username'],
											'id'=>$user['id'],
											'fullnames'=>$user['fullnames'],
											'group'=>$user['group']);
		$_SESSION['isAdminLogin'] = true;
	}
	private function updateLastLogin($user_id){
		$this->db->query("UPDATE admins SET last_login = NOW() WHERE id = ?",intval($user_id));
	}
}
?>