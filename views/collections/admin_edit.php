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
                        <li><a href="#tabs-1">Modify Item</a></li>
                        
                      </ul>
                      <div id="tabs-1" class="tabcontent">
                        <form class="pure-form pure-form-stacked" 
                              action="<?=url('admin/collections/update')?>" 
                              method="POST" 
                              enctype="multipart/form-data">
                            <fieldset>
                                <div class="pure-control-group">
                                    <input name="name" type="text" placeholder="Nama Karya" class="pure-input-2-3" value="<?=$rs['name']?>">
                                </div>
                                <div class="pure-control-group">
                                    <label>Deskripsi</label>
                                    <textarea  name="desc" placeholder="Deskripsi Lengkap" class="pure-input-2-3 editor"><?=$rs['descr']?></textarea>
                                </div>
                                <div class="pure-control-group">
                                    <input name="invent_no" type="text" placeholder="Nomor Inventory" class="pure-input-2-3" value="<?=$rs['invent_no']?>">
                                </div>
                                 <div class="pure-control-group">
                                    <input name="no_reg" type="text" placeholder="Nomor Registrasi" class="pure-input-2-3" value="<?=$rs['no_reg']?>" >
                                </div>
                                <div class="pure-control-group">
                                    <input name="no_slide" type="text" placeholder="Nomor Slide" class="pure-input-2-3" value="<?=$rs['no_slide']?>" >
                                </div>
                                <div class="pure-control-group">
                                    <input name="create_date" type="text" placeholder="Tahun" class="pure-input-2-3" value="<?=date("Y",strtotime($rs['create_date']))?>" >
                                </div>
                                <div class="pure-control-group">
                                    <input name="matrial" type="text" placeholder="Matrial" class="pure-input-2-3" value="<?=$rs['matrial']?>" >
                                </div>
                                <div class="pure-control-group">
                                    <input name="size" type="text" placeholder="Size" class="pure-input-2-3" value="<?=$rs['size']?>" >
                                </div>
                                 <div class="pure-control-group">
                                    <input name="obtain" type="text" placeholder="Diambil dari" class="pure-input-2-3" value="<?=$rs['obtain']?>" >
                                </div>
                                <div class="pure-control-group">
                                    <label>Cara Perolehan</label>
                                    <select name="obtained_way_id">
                                        <?=select_options(get('obtainways'),'id','name',$rs['obtained_way_id'])?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Artist</label>
                                    <select name="artist_id">
                                        <?=select_options(get('artists'),'id','name',$rs['artist_id'])?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Curator</label>
                                    <select name="curator_id">
                                         <?=select_options(get('curators'),'id','name',$rs['curator_id'])?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Jenis Karya</label>
                                    <select name="art_type_id">
                                         <?=select_options(get('art_types'),'id','name',$rs['art_type_id'])?>
                                        
                                    </select>
                                </div>
                                
                                <div class="pure-control-group">
                                    <label>Kondisi</label>
                                    <select name="art_condition_id">
                                        <?=select_options(get('art_conditions'),'id','name',$rs['art_condition_id'])?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Existancy</label>
                                    <select name="exist_stat_id">
                                        <?=select_options(get('exist_stats'),'id','name',$rs['exist_stat_id'])?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Artist Signed ? </label>
                                    <select name="artist_sign">
                                        <?=select_options(array(array('id'=>1,'name'=>'Ya'),array('id'=>'0','name'=>'Tidak')),'id','name',$rs['artist_sign'])?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Tempat Penyimpanan </label>
                                    <select name="storage_id">
                                        <?=select_options(get('storages'),'id','name',$rs['storage_id'])?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label for="name">Foto</label>
                                    <div class="thumb">
                                        <img src="<?=url('content/'.$rs['image'])?>"/>
                                    </div>
                                    <input name="pic" type="file" placeholder="Ketik Url File" class="pure-input-2-3" >
                                </div>
                                 <div class="pure-control-group">
                                    <label>Di update oleh</label>
                                    <input type="text" name='updatedBy' value="<?=$_SESSION['session_admin']['fullnames']?>" class="pure-input-2-3" >
                                    <input type="hidden" name="id" value="<?=intval($rs['id'])?>"/>
                                </div>
                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Submit</button>
                                    <button class="pure-button pure-button-primary">Reset</button>
                                </div>
                            </fieldset>
                        </form>
                      </div><!-- end .tabcontent -->
                      
                    </div><!-- end #tabs -->
                <?php else:?>
                <h3>ACCESS DENIED</h3>
                <?php endif;?>
                </div><!-- end .col1 -->
            </div><!-- end .row -->
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->
