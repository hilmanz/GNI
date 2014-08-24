<?php
use Cocur\Slugify\Slugify;
class CuratorsAdmin extends Controller{
	public function anyIndex(){
		$rs = $this->getCurators();
		set('data',$rs);
		return render('curators/admin_index');
	}
	public function postAdd(){
		$params = array('name'=>h($_POST['name']),
						'descr'=>($_POST['descr'])
				  );
		
		$rs = $this->db->save('curators',$params);

		if($rs!=0){
			$msg = "Data Kurator baru telah berhasil disimpan";
		}else{
			$msg = "Tidak berhasil menyimpan data, silahkan coba kembali nanti !";
		}
		setFlash($msg);
		redirect('/admin/curators');
	}
	public function postUpdate(){
		$id = intval($_POST['id']);

		$rs = $this->getCuratorById($id);

		$params = array('name'=>h($_POST['name']),
						'descr'=>($_POST['descr'])
				  );
		
		$update = $this->db->update($id,'curators',$params);

		if($update!=0){
			$msg = "Perubahan data  `".$rs['name']."` telah berhasil disimpan";
		}else{
			$msg = "Tidak berhasil merubah data `".$rs['name']."`, silahkan coba kembali nanti !";
		}
		setFlash($msg);
		redirect('/admin/curators');
	}
	public function getDelete($id){
		global $upload_path;
		$confirm = intval(@$_GET['confirm']);
		$id = intval($id);
		$rs = $this->getCuratorById($id);

		set('rs',$rs);

		if($confirm==1){
			$del = $this->db->delete($id,'curators');
			
			if($del>0){
				setFlash("Data `{$rs['name']}` telah berhasil dihapus !");
				//remove the physical file
				@unlink($upload_path.'/'.$rs[0]['image']);
			}else{
				setFlash("Data `{$rs['name']}` tidak berhasil dihapus. Silahkan coba kembali !");
			}
			return redirect('/admin/curators');
		}else{
			return render('curators/admin_confirm_delete');
		}
	}
	public function getEdit($id){
		$id = intval($id);

		$rs = $this->getCuratorById($id);

		set('rs',$rs);
		
		return render('curators/admin_edit');
	}
	private function isValid($str){
		
		if(eregi("[a-zA-Z0-9\-\_]+",$str)){
			return true;
		}
	}
	public function getCuratorById($id){
		return $this->db->get($id,'curators');
	}
	public function getCurators(){
		$limit = intval($_REQUEST['total']);
		if($limit == 0){
			$limit = 10;
		}

		$start = intval($_REQUEST['start']);
		if(strlen($_REQUEST['search']) > 0 && $this->isValid($_REQUEST['search'])){
			$search = htmlspecialchars($_REQUEST['search']);
			$results = $this->db->query("SELECT * FROM curators 
										WHERE name LIKE '%{$search}%' 
										LIMIT {$start},{$limit};");
			
			$sql = "SELECT COUNT(a.id) as total
					FROM curators
					WHERE name LIKE '%{$search}%'";
			$total = $this->db->query($sql);
		}else{
			$results = $this->db->query("SELECT * FROM curators ORDER BY name LIMIT {$start},{$limit};");

			$sql = "SELECT COUNT(id) as total FROM curators";
			$total = $this->db->query($sql);
		}

		

		return array('rs'=>$results,'rows'=>$total[0]['total']);
	}
}	
?>