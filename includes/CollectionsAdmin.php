<?php
class CollectionsAdmin extends Controller{
	public function anyIndex(){
		$data = $this->getCollections();
		set('data',$data);
		return render('collections/admin_index');
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
		$rs = $this->db->save('collections',array(
			'name'=>'test',
			'artist_id'=>1,
		));
		//pr($this->db->getLastSQL());
		if($rs!=0){
			$msg = "Data has been saved successfully !";
		}else{
			$msg = "";
		}
	}
	private function isValid($str){
		
		if(eregi("[a-zA-Z0-9\-\_]+",$str)){
			return true;
		}
	}
}	
?>