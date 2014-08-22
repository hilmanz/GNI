<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php include("meta.php"); ?>
<body id="login-page">
<div id="body">
    <div id="page">
        <?php include("header.php"); ?>
        <div id="wraplogin">
            <div class="loginbox">
               <form name="Form2" method="POST" action="http://manage.touchbaseconnect.com/login/local" id="Form2">
                    <input name="username" placeholder="Username" type="text" id="username" maxlength="20"> 
                    <input name="password" placeholder="Password" type="password" id="password" maxlength="20">
                    <input id="button" type="submit" name="Submit" value="Login">
                    <input type="hidden" name="login" value="1">
                </form>	
            </div><!--loginbox-->
        </div>
    </div><!-- end #page -->
</div><!-- end #body --> 			
</body>
</html>