<?php
use Cocur\Slugify\Slugify;
class UsersAdmin extends Controller{
	public function anyIndex(){
		$rs = $this->getTypes();
		set('data',$rs);
		return render('users/admin_index');
	}
	public function postAdd(){
		if(strlen($_POST['password'])<6){
			$msg = "Password tidak boleh kurang dari 6 digit silahkan coba kembali !";
		}else{
			$hash = md5($_POST['password'].md5($_POST['username']));
			$params = array('fullnames'=>h($_POST['fullnames']),
							'username'=>h($_POST['username']),
							'password'=>$hash,
							'created'=>now(),
							'modified'=>now(),
							'role'=>h($_POST['role'])
					  );
			
			$rs = $this->db->save('admins',$params);
			
			if($rs!=0){
				$msg = "User baru telah berhasil ditambahkan";
			}else{
				$msg = "Tidak berhasil menyimpan data, silahkan coba kembali nanti !";
			}
		}
		
		setFlash($msg);
		redirect('/admin/users');
	}
	public function postUpdate(){

		$id = intval($_POST['id']);

		$rs = $this->getTypesById($id);
		if(strlen($_POST['password'])<6){
			$msg = "Password tidak boleh kurang dari 6 digit silahkan coba kembali !";
		}else{
			
			$hash = md5($_POST['password'].md5($_POST['username']));
			$params = array('fullnames'=>h($_POST['fullnames']),
							'username'=>h($_POST['username']),
							'password'=>$hash,
							'modified'=>now(),
							'role'=>h($_POST['role'])
					  );
			
			$update = $this->db->update($id,'admins',$params);

			if($update!=0){
				$msg = "Perubahan data  `".$rs['fullnames']."` telah berhasil disimpan";
			}else{
				$msg = "Tidak berhasil merubah data `".$rs['fullnames']."`, silahkan coba kembali nanti !";
			}
		}
		setFlash($msg);
		redirect('/admin/users');
	}
	public function getDelete($id){
		global $upload_path;
		$confirm = intval(@$_GET['confirm']);
		$id = intval($id);
		$rs = $this->getTypesById($id);

		set('rs',$rs);

		if($confirm==1){
			$del = $this->db->delete($id,'admins');
			
			if($del>0){
				setFlash("Data `{$rs['fullnames']}` telah berhasil dihapus !");
				//remove the physical file
				@unlink($upload_path.'/'.$rs[0]['image']);
			}else{
				setFlash("Data `{$rs['fullnames']}` tidak berhasil dihapus. Silahkan coba kembali !");
			}
			return redirect('/admin/users');
		}else{
			return render('users/admin_confirm_delete');
		}
	}
	public function getEdit($id){
		$id = intval($id);

		$rs = $this->getTypesById($id);

		set('rs',$rs);
		
		return render('users/admin_edit');
	}
	private function isValid($str){
		
		if(eregi("[a-zA-Z0-9\-\_]+",$str)){
			return true;
		}
	}
	public function getTypesById($id){
		return $this->db->get($id,'admins');
	}
	public function getTypes(){
		$limit = intval($_REQUEST['total']);
		if($limit == 0){
			$limit = 10;
		}

		$start = intval($_REQUEST['start']);
		if(strlen($_REQUEST['search']) > 0 && $this->isValid($_REQUEST['search'])){
			$search = htmlspecialchars($_REQUEST['search']);
			$results = $this->db->query("SELECT * FROM admins 
										WHERE fullnames LIKE '%{$search}%' 
										LIMIT {$start},{$limit};");
			
			$sql = "SELECT COUNT(a.id) as total
					FROM admins
					WHERE fullnames LIKE '%{$search}%'";
			$total = $this->db->query($sql);
		}else{
			$results = $this->db->query("SELECT * FROM admins ORDER BY fullnames LIMIT {$start},{$limit};");

			$sql = "SELECT COUNT(id) as total FROM admins";
			$total = $this->db->query($sql);
		}

		

		return array('rs'=>$results,'rows'=>$total[0]['total']);
	}
}	
?>