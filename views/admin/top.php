
<div id="top">
	<div class="wrapper">
        <a id="logo" href="index.php">DATABASE KARYA SENI GALERI NASIONAL INDONESIA</a>
        <a class="boxbtn" href="<?=url('/admin/logout')?>"><span class="ico icon-lock">&nbsp;</span></a>
        <!--<a class="boxbtn" href="#"><span class="ico icon-cog2">&nbsp;</span></a>-->
        <a class="boxbtn" href="#">
            <span class="thumb-s"><img src="content/user.png" /></span>
            <span class="username">Hi, <?=$_SESSION['session_admin']['fullnames']?></span>
        </a>
    </div><!-- end .wrapper -->   
</div><!-- end #top --> 