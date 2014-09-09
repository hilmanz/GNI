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
	array('route'=>'artists','class'=>'Artists'),
	array('route'=>'curators','class'=>'Curators'),
	array('route'=>'art-types','class'=>'ArtTypes'),
	array('route'=>'conditions','class'=>'Conditions'),
	array('route'=>'status','class'=>'Status'),
	array('route'=>'matrials','class'=>'Matrials'),
	array('route'=>'metode','class'=>'Metode'),
	array('route'=>'storages','class'=>'Storages'),
	array('route'=>'users','class'=>'Users')
);


//ACLs
$ACL = array('SUPERVISOR'=>array('read'=>1,'write'=>1,'credential'=>1),
			  'EDITOR'=>array('read'=>1,'write'=>1,'credential'=>0),
			  'READONLY'=>array('read'=>1,'write'=>0,'credential'=>0),
			  'ADMINISTRATOR'=>array('read'=>1,'write'=>1,'credential'=>1),
			  'MANAGER'=>array('read'=>1,'write'=>1,'credential'=>0),
			  'USER'=>array('read'=>1,'write'=>0,'credential'=>0)
			 );

$PDF_DOWNLOAD_DIR = "/home/duf/htdocs/gni/public/content/koleksi_gni.pdf";

?>