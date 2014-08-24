<?php
$rs = get('rs');

?>

<div class="page_section" id="dashboard-page">
    <div id="container">

        <div class="titlebox">
            <h2 class="fl"><span class="icon-newspaper">&nbsp;</span> Database Kurator</h2>
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
                        <li><a href="#tabs-1">Ubah Data Kurator</a></li>
                        <li><a href="#tabs-2">Petunjuk</a></li>
                      </ul>
                      <div id="tabs-1" class="tabcontent">
                        <form class="pure-form pure-form-stacked" 
                              action="<?=url('admin/curators/update')?>" 
                              method="POST" 
                              enctype="multipart/form-data">
                            <fieldset>
                                <div class="pure-control-group">
                                    <input name="name" type="text" placeholder="Nama Lengkap" class="pure-input-2-3" value="<?=$rs['name']?>">
                                </div>
                                <div class="pure-control-group">
                                    <label>Deskripsi</label>
                                    <textarea  name="descr" placeholder="Deskripsi Lengkap" class="pure-input-2-3 editor"><?=$rs['descr']?></textarea>
                                </div>
                                <div class="pure-controls">
                                    <input type="hidden" name="id" value="<?=intval($rs['id'])?>"/>
                                    <button type="submit" class="pure-button pure-button-primary">Simpan</button>
                                    <button class="pure-button pure-button-primary">Reset</button>
                                </div>
                            </fieldset>
                        </form>
                      </div><!-- end .tabcontent -->
                      <div id="tabs-2" class="tabcontent">
                        <h3>Petunjuk</h3>
                        <p>Lorem ipsum dolor sit amet</p>
                      </div><!-- end .tabcontent -->
                    </div><!-- end #tabs -->
                </div><!-- end .col1 -->
            </div><!-- end .row -->
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->