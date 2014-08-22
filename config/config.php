<?php
//URL SETUP
$json_slug = "json"; //if we found json_slug in one of parameter, then we assume the output will be a JSON
$xml_slug = "xml";//if we found xml_slug in one of parameter, then we assume the output will be a XML
$base_url = "http://localhost/duf/gni";
$app_path = "/home/duf/htdocs/gni";
$secret = md5("gninotgnu4ndb4b00n5");
$upload_path = $app_path.'/public/content';
//SETUP THE CONTROLLERS HERE
//frontend controllers
$controllers = array(
	array('route'=>'login','class'=>'Login'),
	array('route'=>'logout','class'=>'Logout'),
	array('route'=>'test','class'=>'Test'),
	array('route'=>'collections','class'=>'Collections'),
);

?>