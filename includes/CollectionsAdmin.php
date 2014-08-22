<?php
use Cocur\Slugify\Slugify;
class CollectionsAdmin extends Controller{
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
	public function getEdit($id){
		$id = intval($id);

		$rs = $this->getCollectionById($id);
		set('rs',$rs);

		$this->populateForm();
		
		return render('collections/admin_edit');
	}
	public function getCollectionById($id){
		$results = $this->db->query("SELECT a.id,a.name,slug, invent_no, matrial, 
				YEAR(create_date) as yr, obtain, created,modified, image,b.name AS artist_name
				FROM collections a
				INNER JOIN artists b ON a.artist_id = b.id 
				WHERE a.id = ? LIMIT 1",$id);
		
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
	    
	    $image = md5($_FILES['pic']['name']).'.'.$ext;
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