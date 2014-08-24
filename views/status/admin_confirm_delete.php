<?php
$rs = get('rs');

?>

<div class="page_section" id="dashboard-page">
    <div id="container">

        <div class="titlebox">
            <h2 class="fl"><span class="icon-newspaper">&nbsp;</span> Pengaturan</h2>
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
                    <div id="tabs">
                      <ul>
                        <li><a href="#tabs-1">Hapus Status Keberadaan Barang</a></li>
                      </ul>
                      <div id="tabs-1" class="tabcontent">
                        <p>Data `<?=$rs['name']?>` akan dihapus dari daftar Status Keberadaan Barang. Anda Yakin ?</p>
                        <a href="<?=url('admin/status/delete/'.$rs['id'].'?confirm=1')?>" class="button4">Yakin</a><a href="<?=url('admin/status')?>" class="button3">Batalkan</a>
                      </div><!-- end .tabcontent -->
                      
                    </div><!-- end #tabs -->
                </div><!-- end .col1 -->
            </div><!-- end .row -->
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->
