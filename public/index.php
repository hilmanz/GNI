<?php
include_once("../bootstrap.php");

//application wide settings can be applied here

//--> end of application wide settings

//default routers
if(!$isAdmin){
	$router->get('/',function(){
		//home page
		$home = new Home();
		return $home->anyIndex();
	});	
}else{

	$router->get('/',function(){
		
		if(!isAdminLogin()){
			print "tidak login";
			redirect('/admin/login');
		}else{
			//home page
			$home = new HomeAdmin();
			return $home->anyIndex();	
		}
		
	});
	$router->get('/access_denied',function(){
		return render('admin/access_denied');
	});

}


//end of default routers

processResponse($router);
