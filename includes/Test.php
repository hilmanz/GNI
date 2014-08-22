<?php
class Test extends Controller{
	
	public function anyIndex(){
		//$rs = $db->query("SELECT * FROM tenribu.accounts WHERE id > ? LIMIT 10;",0);
		$rs = $this->db->query("DELETE FROM tenribu.accounts WHERE id = ?",44);
		return "test nih";
	}

	
	public function getData(){
		return "html data nih";
	}

	//sample json
	public function getJson($action){
		$arr = func_get_args();

		return array('status'=>1);
	}

	public function anyGeneratePassword(){

		$rs = $this->db->query("SELECT * FROM admins");
		foreach($rs as $r){
			$new_pass = "111111";
			$hash = md5($new_pass.md5($r['username']));
			
			$this->db->query("UPDATE admins SET password = ? WHERE id = ?",$hash,$r['id']);
		}
		
	}
}
?>