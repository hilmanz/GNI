<?php
$rs = get('data');
$data = $rs['rs'];
$total_data = $rs['rows'];
$total = intval($_REQUEST['total']);
if($total==0) $total = 10;
set('total_rows',$total_data);
set('params','search='.h($_REQUEST['search']).'&total='.$total);
$search_query = $_REQUEST['search'];

?>

<div class="page_section" id="dashboard-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-newspaper">&nbsp;</span> Collections</h2>
        </div><!-- end .titlebox -->
        <div class="content">
        	<div class="row">
            	<div class="col1">
                    <div id="tabs">
                      <ul>
                        <li><a href="#tabs-1">Collections</a></li>
                        <li><a href="#tabs-2">Add Item</a></li>
                      </ul>
                      <div id="tabs-1" class="tabcontent">
                      <div class="shorter">
                      	<form class="pure-form shortTable">
                        	<span>Show</span>
                                <select id="state">
                                    <option>10</option>
                                    <option>20</option>
                                    <option>30</option>
                                    <option>40</option>
                                </select>
                            <span>Entries</span>
                        </form>
                        <form class="pure-form searchBox" action="<?=url('admin/collections/')?>" method="GET" enctype="application/x-www-form-urlencoded">
                            <input type="text" name="search" value="" placeholder="Judul, Nama Seniman, Nomor Inventory, Tahun" class="">
                            <input type="hidden" name="total" value="<?=$limit?>"/>
                            <input type="hidden" name="start" value="0"/>
                            <button type="submit" class="pure-button btnSearch"><span class="icon-search">&nbsp;</span></button>
                        </form>
                      </div>
                      <table class="pure-table pure-table-bordered">
                            <thead>
                                <tr>
                                    <th width="1" class="center">No</th>
                                    <th>Named</th>
                                    <th>Artist</th>
                                    <th>Obtained From</th>
                                    <th>Year</th>
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
                                    <td><?=$data[$i]['name']?></td>
                                    <td><?=$data[$i]['artist_name']?></td>
                                    <td><?=$data[$i]['obtain']?></td>
                                    <td><?=$data[$i]['yr']?></td>
                                    <td><?=$data[$i]['invent_no']?></td>
                                    <td class="center">
                                    	<a href="#" class="iconbtn"><span class="icon-pencil">&nbsp;</span></a>
                                    	<a href="#" class="iconbtn"><span class="icon-trash">&nbsp;</span></a>
                                    </td>
                                </tr>
                                <?php endfor;?>
                            </tbody>
                        </table>
                        <?php
                        getView('admin/paging');
                        ?>
                      </div><!-- end .tabcontent -->
                      <div id="tabs-2" class="tabcontent">
                        <form class="pure-form pure-form-stacked" action="<?=url('admin/collections/add')?>" method="POST" enctype="application/x-www-form-urlencoded">
                            <fieldset>
                                <div class="pure-control-group">
                                    <input type="text" placeholder="Nama Karya" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <label>Deskripsi</label>
                                    <textarea placeholder="Deskripsi Lengkap" class="pure-input-2-3 editor" ></textarea>
                                </div>
                                <div class="pure-control-group">
                                    <input type="text" placeholder="Nomor Inventory" class="pure-input-2-3" >
                                </div>
                                 <div class="pure-control-group">
                                    <input type="text" placeholder="Nomor Registrasi" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <input type="text" placeholder="Nomor Slide" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <input type="text" placeholder="Tahun" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <input type="text" placeholder="Matrial" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <input type="text" placeholder="Size" class="pure-input-2-3" >
                                </div>
                                 <div class="pure-control-group">
                                    <input type="text" placeholder="Diambil dari" class="pure-input-2-3" >
                                </div>
                                <div class="pure-control-group">
                                    <label>Cara Perolehan</label>
                                    <select name="obtained_way_id">
                                        <option>Lelang</option>
                                        <option>Hibah</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Artist</label>
                                    <select name="artist_id">
                                        <option>Foo</option>
                                        <option>Bar</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Curator</label>
                                    <select name="curator_id">
                                        <option>Foo</option>
                                        <option>Bar</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Jenis Karya</label>
                                    <select name="art_type_id">
                                        <option>asdsad</option>
                                        <option>asdsadsa</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Kondisi</label>
                                    <select name="art_condition_id">
                                        <option>Baik</option>
                                        <option>Perlu Perbaikan</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Kondisi</label>
                                    <select name="art_condition_id">
                                        <option>Baik</option>
                                        <option>Perlu Perbaikan</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Artist Signed ? </label>
                                    <select name="art_condition_id">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label>Tempat Penyimpanan </label>
                                    <select name="storage_id">
                                        <option value="1">Location A</option>
                                        <option value="0">Location B</option>
                                    </select>
                                </div>
                                <div class="pure-control-group">
                                    <label for="name">Foto</label>
                                    <input type="file" placeholder="Ketik Url File" class="pure-input-2-3" >
                                </div>
                                 <div class="pure-control-group">
                                    <input type="text" placeholder="Di update oleh" class="pure-input-2-3" >
                                </div>
                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Submit</button>
                                    <button class="pure-button pure-button-primary">Reset</button>
                                </div>
                            </fieldset>
                        </form>
                      </div><!-- end .tabcontent -->
                    </div><!-- end #tabs -->
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