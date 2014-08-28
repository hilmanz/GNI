

<div id="wraplogin">
    <div class="logo-box">
        <img src="<?=url('images/logo.jpg')?>"/>
        <img src="<?=url('images/logo-twh.png')?>"/>
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
