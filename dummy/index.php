<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php include("meta.php"); ?>
<body>
<div id="body">
    <div id="page">
        <?php include("header.php"); ?> 
        <?php include("sidebar.php"); ?> 
        <div id="thecontent">
		<?php 
        if(@$_GET['page']=='agama'){
            include("agama.php");
        }else if(@$_GET['page']=='form'){ 
            include("form.php");
        }else if(@$_GET['page']=='notification'){ 
            include("notification.php");
        }else if(@$_GET['page']=='setting'){ 
            include("setting.php");
        }else if(@$_GET['page']=='news'){ 
            include("news.php");
		}else if(@$_GET['page']=='dashboard'){ 
            include("dashboard.php");
        }else{ 
            include("dashboard.php");
        }?>
      </div>
    </div><!-- end #page -->
</div><!-- end #body -->		
</body>
</html>