
<div id="top">
	<div class="wrapper">
        <div class="logo twh"><img src="<?=url('/images/TWD.jpg')?>"/></div>
        <div class="logo"><img src="<?=url('/images/logo.jpg')?>"/></div>
        <div class="judul"><a href="<?=url('/admin/')?>">Database Koleksi Karya Seni Rupa Galeri Nasional Indonesia</a></div>
        <a class="boxbtn" href="<?=url('/admin/logout')?>"><span class="ico icon-lock">&nbsp;</span></a>
        <!--<a class="boxbtn" href="#"><span class="ico icon-cog2">&nbsp;</span></a>-->
        <a class="boxbtn" href="#">
            <!--<span class="thumb-s"><img src="content/user.png" /></span>-->
            <span class="username">Hi, <?=$_SESSION['session_admin']['fullnames']?></span>
        </a>
    </div><!-- end .wrapper -->   
</div><!-- end #top --> 