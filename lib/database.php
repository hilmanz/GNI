<?php
class DB{
	private $conn;
	private $instance;
	private $row_counts=0;
	private $last_queries = array();
	public function init($setting){
		global $database;
		$this->instance = new PDO("mysql:host={$database[$setting]['host']};dbname={$database[$setting]['database']};charset=utf8", 
					 $database[$setting]['user'], $database[$setting]['password']);
	}
	public function query(){
		$args = func_get_args();
		
		if(is_array($args[1])){

			$p1 = $args[0];
			$p2 = $args[1];
			
			$args = $args[1];
			$args = array($p1);
			foreach($p2 as $p){
				$args[] = $p;
			}
			array_unshift($p1, $args);
			
		}
		if(eregi("UPDATE|INSERT|DELETE",$args[0])){
			return $this->updateQuery($args);
		}else{
			return $this->fetch($args);
		}
	}
	public function fetch($args){
		$sql = $args[0];
		array_shift($args);
		$this->last_queries[] = $this->interpolateQuery($sql,$args);
		$stmt = $this->instance->prepare($sql);
		
		$stmt->execute($args);
		$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$this->row_counts = $stmt->rowCount();

		return $rs;
	}
	/*
	*@return affectedRows
	*/
	public function updateQuery($args){
		$sql = $args[0];
		array_shift($args);
		$this->last_queries[] = $this->interpolateQuery($sql,$args);
		$stmt = $this->instance->prepare($sql);
		$stmt->execute($args);
		$count = $stmt->rowCount();
		return $count;
	}
	public function getLastId(){
		return $this->instance->lastInsertId();
	}
	public function getLastSQL(){

		return $this->last_queries;
	}
	/**
	 * Replaces any parameter placeholders in a query with the value of that
	 * parameter. Useful for debugging. Assumes anonymous parameters from 
	 * $params are are in the same order as specified in $query
	 *
	 * @param string $query The sql query with parameter placeholders
	 * @param array $params The array of substitution parameters
	 * @return string The interpolated query
	 */
	public function interpolateQuery($query, $params) {
	    $keys = array();
	    $values = $params;

	    # build a regular expression for each parameter
	    foreach ($params as $key => $value) {
	        if (is_string($key)) {
	            $keys[] = '/:'.$key.'/';
	        } else {
	            $keys[] = '/[?]/';
	        }

	        if (is_array($value))
	            $values[$key] = implode(',', $value);

	        if (is_null($value))
	            $values[$key] = 'NULL';
	    }
	    // Walk the array to see if we can add single-quotes to strings
	    array_walk($values, create_function('&$v, $k', 'if (!is_numeric($v) && $v!="NULL") $v = "\'".$v."\'";'));

	    $query = preg_replace($keys, $values, $query, 1, $count);

	    return $query;
	}

	public function save($table,$params){
		$sql = "INSERT INTO {$table}(";
		$i=0;
		$values = "";
		$vals = array();
		foreach($params as $name=>$val){
			if($i>0){
				$sql.=",";
				$values.=",";
			}
			$sql.="{$name}";
			$values.="?";
			$vals[] = $val;
			$i++;
		}
		$sql.=") VALUES( ".$values." );";
		
		return $this->query($sql,$vals);
	}
	public function update($id,$table,$params){
		$sql = "UPDATE {$table} SET ";
		$vals = array();
		$i=0;
		foreach($params as $name=>$val){
			if($name!='id'){
				if($i>0){
					$sql.=",";
				}
				$sql.=$name.'=?';
				$vals[] = $val;
				$i++;
			}
		}
		$sql.=" WHERE id = ?";
		$vals[] = $id;
		return $this->query($sql,$vals);
	}

	//get single row from a table by its id
	public function get($id,$table){
		$rs = $this->query("SELECT * FROM {$table} WHERE id = ? LIMIT 1",$id);
		return $rs[0];
	}
	public function saveAndUpdate($table,$params,$update_fields){
		$sql = "INSERT INTO {$table}(";
		$i=0;
		$values = "";
		$vals = array();
		$updates = "";
		foreach($params as $name=>$val){
			if($i>0){
				$sql.=",";
				$values.=",";
			}
			$sql.="{$name}";
			$values.="?";
			$vals[] = $val;
			$i++;
		}
		for($i=0;$i<sizeof($update_fields);$i++){
			if($i>0){
				$updates.=",";
			}
			$updates.="{$update_fields[$i]} = VALUES ({$update_fields[$i]})";
		}
		$sql.=") VALUES( ".$values." ) ON DUPLICATE UPDATE {$updates}";
	}
	public function delete($id,$table){
		return $this->query("DELETE FROM {$table} WHERE id = ?",$id);
	}
	public function sql(){
		return $this->getLastSQL();
	}
}
?>