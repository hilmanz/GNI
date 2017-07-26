<?php
class HomeAdmin extends Controller{
	public function anyIndex(){
		$total_collections = $this->getTotalCollections();
		$total_artists = $this->getTotalArtists();
		$total_damaged = $this->getTotalDamaged();
		$overall = $this->getOverallCounts();
		set('total_collections',$total_collections);
		set('total_artists',$total_artists);
		set('total_damaged',$total_damaged);
		set('overall',$overall);
		return render('admin/home');
	}

	private function getTotalCollections(){
		$rs = $this->db->query('SELECT COUNT(*) AS total FROM collections;');
		return $rs[0]['total'];
	}
	private function getTotalArtists(){
		$rs = $this->db->query('SELECT COUNT(*) AS total FROM artists;');
		return $rs[0]['total'];
	}
	private function getTotalDamaged(){
		$rs = $this->db->query("SELECT COUNT(*) AS total FROM collections WHERE art_condition_id = 2");
		return $rs[0]['total'];

	}
	private function getOverallCounts(){
		$_SESSION['collections_by_date'] = null;
		if(!isset($_SESSION['collections_by_date'])){
			$rs = $this->db->query("SELECT * FROM (SELECT DATE(created) AS dt,COUNT(*) AS total FROM collections GROUP BY DATE(created) ORDER BY dt DESC LIMIT 10) a ORDER BY dt ASC");	
			if(sizeof($rs)>0){
				$_SESSION['collections_by_date'] = $rs;	
			}
			
		}else{
			$rs = $_SESSION['collections_by_date'];
		}
		return $rs;
	}
}
?>