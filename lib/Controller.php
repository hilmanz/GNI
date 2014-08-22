<?php
class Controller{
	var $db;
	function __construct(){
		global $db;
		$this->db = $db;
	}

}