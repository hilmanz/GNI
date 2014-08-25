<?php
$output = 'html'; //type of output : html, json, plain
$isAdmin = false;
$current_path = "/";
$params = array();
define("_SLASH_","/");
function processInput($uri){  
	
	global $output,$base_url,$current_path;

	$chunk = explode('?',$_SERVER['REQUEST_URI']);

	$c = explode('/',implode('/',explode('/',str_replace("https://","",str_replace("http://","",$base_url)))));
	$arr = explode('/', $chunk[0]);
	array_shift($c);
	
	$uri = "";
	$n=0;
	for($i=0;$i<sizeof($arr);$i++){
		
		if(!in_array($arr[$i],$c) && $arr[$i]!=''){
			if($n>0){
				$uri.="/";
			}
			$uri.=$arr[$i];
			$n++;
		}
	}
	
	//temporary hack to handle 'admin' route
	if($uri=='admin'){
		$uri='';
	}

	$current_path = $uri;
	
	if(eregi('json',$uri)){
		$output = 'json';
	}else{
		$output = 'html';
	}
	if(eregi('.css',$uri)){
		$uri = $base_url._SLASH_.$uri;
		header($uri);
		exit();
	}

    return $uri;    
}

function processOutput($response){
	global $output,$isAdmin;
	$content = $response;
	
	if($output=='html' && !$isAdmin){
		require_once "../views/header.php";
		require_once "../views/body.php";
		require_once "../views/footer.php";	
	}else if($output=='html' && $isAdmin){
		require_once "../views/admin/header.php";
		require_once "../views/admin/body.php";
		require_once "../views/admin/footer.php";	
	}else{
		print json_encode($response);
	}
	
}

function processResponse($router){
	$dispatcher = new Phroute\Dispatcher($router);
	try {
	    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], processInput($_SERVER['REQUEST_URI']));
	} catch (Phroute\Exception\HttpRouteNotFoundException $e) {
	    pr($e);      
	    die();
	} catch (Phroute\Exception\HttpMethodNotAllowedException $e) {
	    pr($e);       
	    die();
	}
	processOutput($response);
}
/*
* wrapper for print_r, only print nicely in html
*/
function pr($obj){
	echo "<pre>";
	print_r($obj);
	echo "</pre>";
}


function redirect($url){
	global $base_url;
	
	if(!eregi('http',$url)){
		header("Location:".$base_url.$url);	
	}else{
		header("Location:".$url);
	}
	
}
function render($name){
	ob_start();
	require_once('../views/'.$name.'.php');
	$test = ob_get_clean();
	
	return $test;
}

function getView($name){
	global $app_path;
	include($app_path.'/views/'.$name.'.php');
}
function isAdminLogin(){
	return $_SESSION['isAdminLogin'];
}
function getAdminSession(){
	return $_SESSION['session_admin'];
}
//write the absolute url of the path
function url($path){
	global $base_url;
	return $base_url._SLASH_.$path;
}
//a shortcut of url($path)
function u($path){
	return url($path);
}
function h($str){
	return htmlentities($str);
}

function setFlash($msg){
	$_SESSION['flash'] = $msg;
}
function getFlash(){
	$msg =  $_SESSION['flash'];
	$_SESSION['flash'] = null;
	return $msg;
}

function getPath(){
	return $current_path;
}
function pathHas($name){
	$p = getPath();
	if(strlen($name)==0 && strlen($p) == 0){
		return true;
	}

	if(@eregi($name,$p)){
		print "yay";
		return true;
	}else{
		print "nay";
	}
}

function set($name,$value){
	global $params;
	$params[$name] = $value;
}
function get($name){
	global $params;
	return $params[$name];
}


function select_options($data,$id,$label,$default=''){
	$str = "";
	for($i=0;$i<sizeof($data);$i++){
		if($default==$data[$i][$id]){
			$str.="<option value='{$data[$i][$id]}' selected='selected'>{$data[$i][$label]}</option>\n";
		}else{
			$str.="<option value='{$data[$i][$id]}'>{$data[$i][$label]}</option>\n";	
		}
		
	}
	return $str;
}

function now(){
	return date("Y-m-d H:i:s");
}


//ADMINs ACL function
function admin_can_read(){
	global $ACL;
	$sess = getAdminSession();
	$role = strtoupper($sess['role']);
	return admin_check_role_acl($role,'read');
}
function admin_can_write(){
	global $ACL;
	$sess = getAdminSession();
	$role = strtoupper($sess['role']);
	
	return admin_check_role_acl($role,'write');
}
function admin_has_credential_access(){
	global $ACL;
	$sess = getAdminSession();
	$role = strtoupper($sess['role']);
	$role ="EDITOR";
	return admin_check_role_acl($role,'credential');
}
function admin_check_role_acl($role,$access_name){
	global $ACL;
	if($ACL[$role][$access_name]==1){
		return true;
	}
}
//--->