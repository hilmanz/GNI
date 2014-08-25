<?php
$rs = get('rs');

?>

<div class="page_section" id="dashboard-page">
    <div id="container">

        <div class="titlebox">
            <h2 class="fl"><span class="icon-newspaper">&nbsp;</span> Collections</h2>
        </div><!-- end .titlebox -->
        <?php
        $msg = getFlash();
        if(strlen($msg)>0):
        ?>
        <div class="msg">
            <?=$msg?>
        </div>
        <?php endif;?>
        <div class="content">
        	<div class="row">
            	<div class="col1">
                    <?php if(admin_can_write()):?>
                    <div id="tabs">
                      <ul>
                        <li><a href="#tabs-1">Remove Item</a></li>
                       
                      </ul>
                      <div id="tabs-1" class="tabcontent">
                        <p>`<?=$rs['invent_no']?> - <?=$rs['name']?>` akan dihapus. Anda Yakin ?</p>
                        <a href="<?=url('admin/collections/delete/'.$rs['id'].'?confirm=1')?>" class="button4">Ya</a><a href="<?=url('admin/collections')?>" class="button3">Tidak</a>
                      </div><!-- end .tabcontent -->
                      
                    </div><!-- end #tabs -->
                    <?php else:?>
                    <h3>Access Denied</h3>
                    <?php endif;?>
                </div><!-- end .col1 -->
            </div><!-- end .row -->
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->
<script>
$("#state").change(function(){
    document.location="?search=<?=$search_query?>&total="+parseInt($(this).val());
});
</script>