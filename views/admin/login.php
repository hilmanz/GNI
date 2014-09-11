

<div id="wraplogin">
    <div class="logo-box">
        <div class="logo2">
             <img src="<?=url('images/LogoGNI.jpg')?>" width="100%"/>
        </div>
        <div class="logo1">
            <img src="<?=url('images/TWD.jpg')?>" width="100%"/>
        </div>
       
    </div>
    <div class="center">
    <h1>Database Koleksi Karya Seni Rupa <br/>Galeri Nasional Indonesia</h1>
    </div>
    <div class="loginbox">
        <?php
        $msg = getFlash();
        if(strlen($msg)>0):
        ?>
        <div class="msg">
            <?=$msg?>
        </div>
        <?php endif;?>
       <form name="Form2" method="POST" action="<?=url('admin/login')?>" id="Form2">
            <input name="username" placeholder="Username" type="text" id="username" maxlength="20"> 
            <input name="password" placeholder="Password" type="password" id="password" maxlength="20">
            <input id="button" type="submit" name="Submit" value="Login">
            <input type="hidden" name="login" value="1">
        </form>	
    </div><!--loginbox-->
</div>
