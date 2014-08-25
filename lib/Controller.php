<?php
class Controller{
	var $db;
	function __construct(){
		global $db,$isAdmin;
		$this->db = $db;
		if($isAdmin && !isAdminLogin()){
			redirect('/admin/login');
		}
		$this->beforeFilter();
	}
	public function beforeFilter(){}

}