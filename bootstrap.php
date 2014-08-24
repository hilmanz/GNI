<?php
session_start();
include_once "vendor/autoload.php";
include_once "config/config.php";
include_once "config/database.php";
include_once "config/locale.php";
include_once "lib/database.php";
include_once "lib/core.php";
include_once "lib/Controller.php";
include_once "lib/Admin.php";
include_once "includes/Home.php";
include_once "includes/HomeAdmin.php";

$scripts = array();
$styles = array();


//--->

//LOAD DATABASE
$db = new DB();
$db->init('default');

//PREPARE ROUTINGS
$suffix = "";
if(eregi('admin',$_SERVER['REQUEST_URI'])){
	$suffix = "Admin";
	$_SERVER['REQUEST_URI'] = str_replace("/admin/","/",$_SERVER['REQUEST_URI']);
	$isAdmin = true;
	
}


//setup the controller
$router = new Phroute\RouteCollector();


//load the controller classes
foreach($controllers as $ctrl){
	try{
		include_once "../includes/".$ctrl['class'].$suffix.".php";
		if(class_exists($ctrl['class'].$suffix)){
			$router->controller($ctrl['route'], $ctrl['class'].$suffix);			
		}
	}catch(Exception $err){
		//do nothing
	}
}
?>