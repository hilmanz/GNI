<?php
$rs = get('data');
$data = $rs['rs'];
$total_data = $rs['rows'];
$total = intval($_REQUEST['total']);
if($total==0) $total = 10;
if($total > 100){
    $total = 100;
}
set('total_rows',$total_data);
set('params','search='.h($_REQUEST['search']).'&total='.$total.'&tahun='.intval($_REQUEST['tahun']));
$search_query = $_REQUEST['search'];
$can_write = admin_can_write();
?>

<div class="page_section" id="dashboard-page">
    <div id="container">

        <div class="titlebox">
            <h2 class="fl"><span class="icon-books">&nbsp;</span> Koleksi</h2>
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
                        <li><a href="#tabs-1">Daftar Koleksi</a></li>
                        <?php if($can_write):?>
                        <li><a href="#tabs-2">Tambah Barang</a></li>
                        <?php endif;?>
                      </ul>
                      <div id="tabs-1" class="tabcontent">
                      <div class="shorter">
                      	<form class="pure-form shortTable">
                             <div style="margin-left:20px;float:left;">
                        	<span>Tampilkan</span>
                                <select id="state">
                                    <option <?php if($total==10):echo "selected='selected'";endif;?>>10</option>
                                    <option <?php if($total==20):echo "selected='selected'";endif;?>>20</option>
                                    <option <?php if($total==30):echo "selected='selected'";endif;?>>30</option>
                                    <option <?php if($total==40):echo "selected='selected'";endif;?>>40</option>
                                </select>
                            <span>Entri</span>
                            </div>
                            
                        </form>
                        <form class="pure-form searchBox" action="<?=url('admin/collections/')?>" method="GET" enctype="application/x-www-form-urlencoded">
                                <div style="margin-left:20px;float:left;"><span>Pencarian</span> </div>
                                <div style="margin-left:20px;float:left;">
                                <input type="text" name="search" value="" placeholder="Judul, Nama Seniman, Nomor Inventory, Tahun" class="">
                                </div>
                            <div style="margin-left:20px;float:left;">
                            <span>Pilih Tahun</span>
                                <select id="state" name="tahun">
                                    <option value="">Semua</option>
                                    <?php $thn = get('years');?>
                                    <?php for($i=0;$i<sizeof($thn);$i++):?>
                                        <?php if($thn[$i]==intval($_REQUEST['tahun'])):?>
                                        <option value="<?=$thn[$i]?>" selected='selected'><?=$thn[$i]?></option>
                                        <?php else:?>
                                        <option value="<?=$thn[$i]?>"><?=$thn[$i]?></option>
                                        <?php endif;?>
                                    <?php endfor;?>
                                </select>
                            
                            </div>
                            <input type="hidden" name="total" value="<?=$limit?>"/>
                            <input type="hidden" name="start" value="0"/>
                            <button type="submit" class="pure-button btnSearch"><span class="icon-search">&nbsp;</span></button>
                        </form>
                      </div>
                      <table class="pure-table pure-table-bordered">
                            <thead>
                                <tr>
                                    <th width="1" class="center">No</th>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>Seniman</th>
                                    <th>Didapatkan Dari</th>
                                    <th>Media</th>
                                    <th>Tahun</th>
                                    <th>Invent No</th>
                                    <th width="100" class="center">Aksi</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                <?php for($i=0;$i<sizeof($data);$i++):?>
                                <?php
                                $no = $i + intval($_REQUEST['start']) + 1;
                                ?>

                                <tr>
                                    <td class="center"><?=$no?></td>
                                    <td> 
                                    	<a class="showPopup" href="#image-<?=$no?>"><img src="<?=url('content/'.$data[$i]['image'])?>" width="70px"/></a>
                                    	<div class="popup">
                                        	<div class="popupContent2" id="image-<?=$no?>">
                                            	<img src="<?=url('content/'.$data[$i]['image'])?>"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="<?=url('admin/collections/edit/'.$data[$i]['id'])?>"><?=$data[$i]['name']?></a></td>
                                    <td><a class="showPopup" href="#seniman-<?=$no?>"><?=$data[$i]['artist_name']?></a>
                                    	<div class="popup">
                                        	<div class="popupContent" id="seniman-<?=$no?>">
                                            	<div class="entry-popup">
                                                    <h3><?=$data[$i]['name']?></h3>
                                                    <h4><?=$data[$i]['artist_name']?></h4>
                                                	<p><?=$data[$i]['artist_desc']?></p>									
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </td>
                                    <td><?=$data[$i]['obtain']?></td>
                                    <td><?=$data[$i]['media']?></td>
                                    <td><?=$data[$i]['yr']?></td>
                                    <td><?=$data[$i]['invent_no']?></td>
                                    <td class="center">
                                       
                                    	
                                    	<?php if($can_write):?>
                                        <a href="<?=url('admin/collections/edit/'.$data[$i]['id'])?>" class="iconbtn"><span class="icon-pencil">&nbsp;</span></a>
                                        <a href="<?=url('admin/collections/delete/'.$data[$i]['id'])?>" class="iconbtn"><span class="icon-trash">&nbsp;</span></a>
                                        <?php else:?>
                                        <a href="<?=url('admin/collections/view/'.$data[$i]['id'])?>" class="iconbtn"><span class="icon-pencil">&nbsp;</span></a>
                                        <?php endif;?>
                                    </td>
                                </tr>
                                <?php endfor;?>
                            </tbody>
                        </table>
                        <?php
                        getView('admin/paging');
                        ?>
                      </div><!-- end .tabcontent -->
                      <?php if($can_write):?>
                      <div id="tabs-2" class="tabcontent">
                        <form class="pure-form pure-form-stacked" 
                              action="<?=url('admin/collections/add')?>" 
                              method="POST" 
                              enctype="multipart/form-data">
                            <fieldset>
                                <div class="pure-control-group">
                                    <input name="name" type="text" placeholder="Nama Karya" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <label>Deskripsi</label>
                                    <textarea  name="desc" placeholder="Deskripsi Lengkap" class="pure-input-2-3 editor" ></textarea>
                                </div>
                                <div class="pure-control-group">
                                    <input name="invent_no" type="text" placeholder="Nomor Inventory" class="pure-input-2-3" >
                                </div>
                                 <div class="pure-control-group">
                                    <input name="no_reg" type="text" placeholder="Nomor Registrasi" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <input name="no_slide" type="text" placeholder="Nomor Slide" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <input name="create_date" type="text" placeholder="Tahun" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <input name="matrial" type="text" placeholder="Matrial" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <input name="size" type="text" placeholder="Size" class="pure-input-2-3" >
                                </div>
                                 <div class="pure-control-group">
                                    <input name="obtain" type="text" placeholder="Diambil dari" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <label>Cara Perolehan</label>
                                    <select name="obtained_way_id">
                                        <?=select_options(get('obtainways'),'id','name')?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Seniman</label>
                                    <select name="artist_id">
                                        <?=select_options(get('artists'),'id','name')?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Kurator</label>
                                    <select name="curator_id">
                                         <?=select_options(get('curators'),'id','name')?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Jenis Karya</label>
                                    <select name="art_type_id">
                                         <?=select_options(get('art_types'),'id','name')?>
                                        
                                    </select>
                                </div>
                                
                                <div class="pure-control-group">
                                    <label>Kondisi</label>
                                    <select name="art_condition_id">
                                        <?=select_options(get('art_conditions'),'id','name')?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Keberadaan</label>
                                    <select name="exist_stat_id">
                                        <?=select_options(get('exist_stats'),'id','name')?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Tandatangan Artis ? </label>
                                    <select name="artist_sign">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Tempat Penyimpanan </label>
                                    <select name="storage_id">
                                        <?=select_options(get('storages'),'id','name')?>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label for="name">Foto</label>
                                    <input name="pic" type="file" placeholder="Ketik Url File" class="pure-input-2-3" >
                                </div>
                                 <div class="pure-control-group">
                                    <label>Di update oleh</label>
                                    <input type="text" name='updatedBy' value="<?=$_SESSION['session_admin']['fullnames']?>" class="pure-input-2-3" >
                                </div>
                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Simpan</button>
                                    <button class="pure-button pure-button-primary">Reset</button>
                                </div>
                            </fieldset>
                        </form>
                      </div><!-- end .tabcontent -->
                        <?php endif;?>
                    </div><!-- end #tabs -->
                </div><!-- end .col1 -->
            </div><!-- end .row -->
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->
<script>
$("#state").change(function(){
    document.location="?search=<?=$search_query?>&tahun=<?=intval($_REQUEST['tahun'])?>&total="+parseInt($(this).val());
});
</script>