<?php
use Cocur\Slugify\Slugify;
class MatrialsAdmin extends Controller{
	public function anyIndex(){
		$rs = $this->getTypes();
		set('data',$rs);
		return render('matrials/admin_index');
	}
	public function postAdd(){
		$params = array('name'=>h($_POST['name'])
				  );
		
		$rs = $this->db->save('matrials',$params);

		if($rs!=0){
			$msg = "Jenis Matrial baru telah berhasil ditambahkan";
		}else{
			$msg = "Tidak berhasil menyimpan data, silahkan coba kembali nanti !";
		}
		setFlash($msg);
		redirect('/admin/matrials');
	}
	public function postUpdate(){
		$id = intval($_POST['id']);

		$rs = $this->getTypesById($id);

		$params = array('name'=>h($_POST['name'])
				  );
		
		$update = $this->db->update($id,'matrials',$params);

		if($update!=0){
			$msg = "Perubahan data  `".$rs['name']."` telah berhasil disimpan";
		}else{
			$msg = "Tidak berhasil merubah data `".$rs['name']."`, silahkan coba kembali nanti !";
		}
		setFlash($msg);
		redirect('/admin/matrials');
	}
	public function getDelete($id){
		global $upload_path;
		$confirm = intval(@$_GET['confirm']);
		$id = intval($id);
		$rs = $this->getTypesById($id);

		set('rs',$rs);

		if($confirm==1){
			$del = $this->db->delete($id,'matrials');
			
			if($del>0){
				setFlash("Data `{$rs['name']}` telah berhasil dihapus !");
				//remove the physical file
				@unlink($upload_path.'/'.$rs[0]['image']);
			}else{
				setFlash("Data `{$rs['name']}` tidak berhasil dihapus. Silahkan coba kembali !");
			}
			return redirect('/admin/matrials');
		}else{
			return render('matrials/admin_confirm_delete');
		}
	}
	public function getEdit($id){
		$id = intval($id);

		$rs = $this->getTypesById($id);

		set('rs',$rs);
		
		return render('matrials/admin_edit');
	}
	private function isValid($str){
		
		if(eregi("[a-zA-Z0-9\-\_]+",$str)){
			return true;
		}
	}
	public function getTypesById($id){
		return $this->db->get($id,'matrials');
	}
	public function getTypes(){
		$limit = intval($_REQUEST['total']);
		if($limit == 0){
			$limit = 10;
		}

		$start = intval($_REQUEST['start']);
		if(strlen($_REQUEST['search']) > 0 && $this->isValid($_REQUEST['search'])){
			$search = htmlspecialchars($_REQUEST['search']);
			$results = $this->db->query("SELECT * FROM matrials 
										WHERE name LIKE '%{$search}%' 
										LIMIT {$start},{$limit};");
			
			$sql = "SELECT COUNT(a.id) as total
					FROM matrials
					WHERE name LIKE '%{$search}%'";
			$total = $this->db->query($sql);
		}else{
			$results = $this->db->query("SELECT * FROM matrials ORDER BY name LIMIT {$start},{$limit};");

			$sql = "SELECT COUNT(id) as total FROM matrials";
			$total = $this->db->query($sql);
		}

		

		return array('rs'=>$results,'rows'=>$total[0]['total']);
	}
}	
?>