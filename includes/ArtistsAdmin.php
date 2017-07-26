<?php
use Cocur\Slugify\Slugify;
class ArtistsAdmin extends Controller{
	public function beforeFilter(){
		global $current_path;
		
		
		if(eregi('edit|delete|add|update',$current_path) && !admin_can_write()){
			redirect('/admin/access_denied');
		}
	}
	public function anyIndex(){
		$rs = $this->getArtists();
		set('data',$rs);
		return render('artists/admin_index');
	}
	public function postAdd(){
		if(admin_can_write()){
			$params = array('name'=>h($_POST['name']),
						'descr'=>($_POST['descr'])
				  );
		
			$rs = $this->db->save('artists',$params);

			if($rs!=0){
				$msg = "Data seniman baru telah berhasil disimpan";
			}else{
				$msg = "Tidak berhasil menyimpan data, silahkan coba kembali nanti !";
			}
			
		}else{
			$msg = "Mohon maaf, akun anda tidak diizinkan untuk mengubah data ini !";
		}
		setFlash($msg);
		redirect('/admin/artists');
	}
	public function postUpdate(){
		if(admin_can_write()){
			$id = intval($_POST['id']);

			$rs = $this->getArtistById($id);

			$params = array('name'=>h($_POST['name']),
							'descr'=>($_POST['descr'])
					  );
			
			$update = $this->db->update($id,'artists',$params);

			if($update!=0){
				$msg = "Perubahan data  `".$rs['name']."` telah berhasil disimpan";
			}else{
				$msg = "Tidak berhasil merubah data `".$rs['name']."`, silahkan coba kembali nanti !";
			}
		}else{
			$msg = "Mohon maaf, akun anda tidak diizinkan untuk mengubah data ini !";
		}
		setFlash($msg);
		redirect('/admin/artists');
	}
	public function getDelete($id){
		if(admin_can_write()){
			global $upload_path;
			$confirm = intval(@$_GET['confirm']);
			$id = intval($id);
			$rs = $this->getArtistById($id);

			set('rs',$rs);

			if($confirm==1){
				$del = $this->db->delete($id,'artists');
				
				if($del>0){
					setFlash("Data `{$rs['name']}` telah berhasil dihapus !");
					//remove the physical file
					@unlink($upload_path.'/'.$rs[0]['image']);
				}else{
					setFlash("Data `{$rs['name']}` tidak berhasil dihapus. Silahkan coba kembali !");
				}
				return redirect('/admin/artists');
			}else{
				return render('artists/admin_confirm_delete');
			}
		}else{
			$msg = "Mohon maaf, akun anda tidak diizinkan untuk mengubah data ini !";
			setFlash($msg);
			return redirect('/admin/artists');
		}
	}
	public function getEdit($id){
		if(admin_can_write()){
			$id = intval($id);
			$rs = $this->getArtistById($id);
			set('rs',$rs);
			return render('artists/admin_edit');
		}else{
			$msg = "Mohon maaf, akun anda tidak diizinkan untuk mengubah data ini !";
			setFlash($msg);
			return redirect('/admin/artists');
		}
	}
	private function isValid($str){
		
		if(eregi("[a-zA-Z0-9\-\_]+",$str)){
			return true;
		}
	}
	public function getArtistById($id){
		return $this->db->get($id,'artists');
	}
	public function getArtists(){
		$limit = intval($_REQUEST['total']);
		if($limit == 0){
			$limit = 10;
		}

		$start = intval($_REQUEST['start']);
		if(strlen($_REQUEST['search']) > 0 && $this->isValid($_REQUEST['search'])){
			$search = htmlspecialchars($_REQUEST['search']);
			$results = $this->db->query("SELECT * FROM artists 
										WHERE name LIKE '%{$search}%' 
										LIMIT {$start},{$limit};");
			
			$sql = "SELECT COUNT(a.id) as total
					FROM artists
					WHERE name LIKE '%{$search}%'";
			$total = $this->db->query($sql);
		}else{
			$results = $this->db->query("SELECT * FROM artists ORDER BY name LIMIT {$start},{$limit};");

			$sql = "SELECT COUNT(id) as total FROM artists";
			$total = $this->db->query($sql);
		}

		

		return array('rs'=>$results,'rows'=>$total[0]['total']);
	}
}	
?>