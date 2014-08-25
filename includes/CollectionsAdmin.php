<?php
use Cocur\Slugify\Slugify;
class CollectionsAdmin extends Controller{
	public function beforeFilter(){
		global $current_path;
		
		if(eregi('edit|delete|add|update',$current_path) && !admin_can_write()){
			redirect('/admin/access_denied');
		}
	}
	public function anyIndex(){
		$data = $this->getCollections();
		set('data',$data);

		$this->populateForm();
		

		return render('collections/admin_index');
	}
	private function populateForm(){
		//form items
		set('artists',$this->getArtists());
		set('curators',$this->getCurators());
		set('matrials',$this->getMatrials());
		set('obtainways',$this->getObtainWays());
		set('storages',$this->getStorages());
		set('exist_stats',$this->getExistStats());
		set('art_types',$this->getArtTypes());
		set('art_conditions',$this->getArtConditions());
	}
	public function getView($id){
		$id = intval($id);

		$rs = $this->getCollectionDetail($id);
		set('rs',$rs[0]);

		$this->populateForm();
		
		return render('collections/admin_view');
	}
	public function getEdit($id){
		$id = intval($id);

		$rs = $this->getCollectionById($id);
		set('rs',$rs[0]);

		$this->populateForm();
		
		return render('collections/admin_edit');
	}
	public function getDelete($id){
		global $upload_path;
		$confirm = intval(@$_GET['confirm']);
		$id = intval($id);
		$rs = $this->getCollectionById($id);

		set('rs',$rs[0]);

		if($confirm==1){
			$del = $this->db->delete($id,'collections');
			
			if($del>0){
				setFlash("`{$rs[0]['invent_no']} - {$rs[0]['name']}` telah berhasil dihapus !");
				//remove the physical file
				@unlink($upload_path.'/'.$rs[0]['image']);
			}else{
				setFlash("`{$rs[0]['invent_no']} - {$rs[0]['name']}` tidak berhasil dihapus. Silahkan coba kembali !");
			}
			return redirect('/admin/collections');
		}else{
			return render('collections/admin_confirm_delete');
		}
	}
	public function postUpdate(){
		global $upload_path;


		$slugify = new Slugify();
		$id = intval($_POST['id']);

		$image = '';
		
		if(strlen($_FILES['pic']['name'])>0){
			$chunk = explode(".",$_FILES['pic']['name']);
		    $ext = array_pop($chunk);

		    $image = md5($_FILES['pic']['name'].rand(0,99999)).'.'.$ext;	
		    if(isset($_FILES['pic'])){
		    	if(!move_uploaded_file($_FILES['pic']['tmp_name'], $upload_path.'/'.$image)){
		    		$image = '';
		    	}
		    }
		}
		
	    
		$params = array('name'=>h($_POST['name']),
						'descr'=>($_POST['desc']),
						'slug'=>$slugify->slugify($_POST['name'],'_'),
						'invent_no'=>h($_POST['invent_no']),
						'no_reg'=>h($_POST['no_reg']),
						'no_slide'=>h($_POST['no_slide']),
						'matrial'=>h($_POST['matrial']),
						'size'=>h($_POST['size']),
						'obtain'=>h($_POST['obtain']),
						'obtained_way_id'=>h($_POST['obtained_way_id']),
						'artist_id'=>h($_POST['artist_id']),
						'curator_id'=>h($_POST['curator_id']),
						'art_type_id'=>h($_POST['art_type_id']),
						'art_condition_id'=>h($_POST['art_condition_id']),
						'exist_stat_id'=>h($_POST['exist_stat_id']),
						'artist_sign'=>h($_POST['artist_sign']),
						'storage_id'=>h($_POST['storage_id']),
						'updatedBy'=>h($_POST['updatedBy']),
						'create_date'=>intval($_POST['create_date'])."-00-00",
						'modified'=>date("Y-m-d H:i:s"),
				  );
		if(strlen($image)>0){
			$params['image'] = $image;
		}
		$rs = $this->db->update($id,'collections',$params);
		if($rs!=0){
			$msg = "`".h($_POST['name'])."` telah berhasil di update.";
		}else{
			$msg = "Tidak berhasil menyimpan data, silahkan coba kembali nanti !";
		}
		setFlash($msg);
		redirect('/admin/collections/edit/'.$id);
	}
	public function getCollectionById($id){
		$results = $this->db->query("SELECT a.*
				FROM collections a
				INNER JOIN artists b ON a.artist_id = b.id 
				WHERE a.id = ? LIMIT 1",$id);
		
		return $results;
	}
	public function getCollectionDetail($id){
		$results = $this->db->query("SELECT a.*,b.name AS artist_name,c.name AS jenis_karya,d.name AS storage_name,
										e.name AS curator,f.name AS keberadaan,g.name AS cara,h.name AS kondisi
											FROM collections a
											INNER JOIN artists b ON a.artist_id = b.id 
											INNER JOIN art_types c
											ON c.id = a.art_type_id
											INNER JOIN storages d
											ON d.id = a.storage_id
											INNER JOIN curators e
											ON e.id = a.curator_id
											INNER JOIN exist_stats f
											ON f.id = a.exist_stat_id
											INNER JOIN obtained_ways g
											ON g.id = a.obtained_way_id
											INNER JOIN art_conditions h
											ON h.id = a.art_condition_id
											WHERE a.id = ? LIMIT 1;",$id);
		
		return $results;
	}
	public function getCollections(){
		$limit = intval($_REQUEST['total']);
		if($limit == 0){
			$limit = 10;
		}

		$start = intval($_REQUEST['start']);
		if(strlen($_REQUEST['search']) > 0 && $this->isValid($_REQUEST['search'])){
			$search = htmlspecialchars($_REQUEST['search']);
			$results = $this->db->query("SELECT a.id,a.name,slug, invent_no, matrial, 
				YEAR(create_date) as yr, obtain, created,modified, image,b.name AS artist_name
				FROM collections a
				INNER JOIN artists b ON a.artist_id = b.id 
				WHERE b.name LIKE '%{$search}%' 
				OR a.name LIKE '%{$search}%' 
				OR YEAR(create_date) LIKE '%{$search}%' 
				OR invent_no LIKE '%{$search}%'
				
				ORDER BY a.id LIMIT {$start},{$limit};");
			
			$sql = "SELECT COUNT(a.id) as total
					FROM collections a
					INNER JOIN artists b ON a.artist_id = b.id
					WHERE b.name LIKE '%{$search}%' 
					OR a.name LIKE '%{$search}%' 
					OR YEAR(create_date) LIKE '%{$search}%' 
					OR invent_no LIKE '%{$search}%'";
			$total = $this->db->query($sql);
		}else{
			$results = $this->db->query("SELECT a.id,a.name,slug, invent_no, matrial, 
				YEAR(create_date) as yr, obtain, created,modified, image,b.name AS artist_name
				FROM collections a
				INNER JOIN artists b ON a.artist_id = b.id  ORDER BY a.id LIMIT {$start},{$limit};");

			$sql = "SELECT COUNT(a.id) as total
					FROM collections a
					INNER JOIN artists b ON a.artist_id = b.id";
			$total = $this->db->query($sql);
	
		}

		

		return array('rs'=>$results,'rows'=>$total[0]['total']);
	}
	public function postAdd(){
		global $upload_path;
		
		$slugify = new Slugify();

	    $chunk = explode(".",$_FILES['pic']['name']);
	    $ext = array_pop($chunk);
	    
	    $image = md5($_FILES['pic']['name'].rand(0,99999)).'.'.$ext;
	    if(isset($_FILES['pic'])){
	    	if(!move_uploaded_file($_FILES['pic']['tmp_name'], $upload_path.'/'.$image)){
	    		$image = '';
	    	}
	    }
		$params = array('name'=>h($_POST['name']),
						'descr'=>($_POST['desc']),
						'slug'=>$slugify->slugify($_POST['name'],'_'),
						'invent_no'=>h($_POST['invent_no']),
						'no_reg'=>h($_POST['no_reg']),
						'no_slide'=>h($_POST['no_slide']),
						'matrial'=>h($_POST['matrial']),
						'size'=>h($_POST['size']),
						'obtain'=>h($_POST['obtain']),
						'obtained_way_id'=>h($_POST['obtained_way_id']),
						'artist_id'=>h($_POST['artist_id']),
						'curator_id'=>h($_POST['curator_id']),
						'art_type_id'=>h($_POST['art_type_id']),
						'art_condition_id'=>h($_POST['art_condition_id']),
						'exist_stat_id'=>h($_POST['exist_stat_id']),
						'artist_sign'=>h($_POST['artist_sign']),
						'storage_id'=>h($_POST['storage_id']),
						'updatedBy'=>h($_POST['updatedBy']),
						'create_date'=>intval($_POST['create_date'])."-00-00",
						'created'=>date("Y-m-d H:i:s"),
						'modified'=>date("Y-m-d H:i:s"),
						'image'=>$image
				  );
		
		$rs = $this->db->save('collections',$params);

		if($rs!=0){
			$msg = "Data baru telah berhasil disimpan";
		}else{
			$msg = "Tidak berhasil menyimpan data, silahkan coba kembali nanti !";
		}
		setFlash($msg);
		redirect('/admin/collections');
	}
	private function getArtists(){
		$rs = $this->db->query("SELECT * FROM artists ORDER BY name LIMIT 10000;");
		return $rs;
	}
	private function getCurators(){
		$rs = $this->db->query("SELECT * FROM curators ORDER BY name LIMIT 10000;");
		return $rs;	
	}
	private function getMatrials(){
		$rs = $this->db->query("SELECT * FROM matrials ORDER BY name LIMIT 10000;");
		return $rs;		
	}
	private function getObtainWays(){
		$rs = $this->db->query("SELECT * FROM obtained_ways ORDER BY name LIMIT 10000;");
		return $rs;		
	}
	private function getStorages(){
		$rs = $this->db->query("SELECT * FROM storages ORDER BY name LIMIT 10000;");
		return $rs;		
	}
	private function getExistStats(){
		$rs = $this->db->query("SELECT * FROM exist_stats ORDER BY name LIMIT 10000;");
		return $rs;		
	}
	private function getArtTypes(){
		$rs = $this->db->query("SELECT * FROM art_types ORDER BY name LIMIT 10000;");
		return $rs;		
	}
	private function getArtConditions(){
		$rs = $this->db->query("SELECT * FROM art_conditions ORDER BY name LIMIT 10000;");
		return $rs;		
	}
	private function isValid($str){
		
		if(eregi("[a-zA-Z0-9\-\_]+",$str)){
			return true;
		}
	}
}	
?>