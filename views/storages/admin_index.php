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
                        <li><a href="#tabs-1">Daftar Tempat Penyimpanan</a></li>
                        <li><a href="#tabs-2">Tambah Data</a></li>
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
                        <form class="pure-form searchBox" action="<?=url('admin/storages/')?>" method="GET" enctype="application/x-www-form-urlencoded">
                            <input type="text" name="search" value="" placeholder="Ketik nama tempat disini" class="">
                            <input type="hidden" name="total" value="<?=$limit?>"/>
                            <input type="hidden" name="start" value="0"/>
                            <button type="submit" class="pure-button btnSearch"><span class="icon-search">&nbsp;</span></button>
                        </form>
                      </div>
                      <table class="pure-table pure-table-bordered">
                            <thead>
                                <tr>
                                    <th width="1" class="center">No</th>
                                    <th>Nama</th>
                                   
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
                                    
                                   
                                    <td class="center">
                                    	<a href="<?=url('admin/storages/edit/'.$data[$i]['id'])?>" class="iconbtn"><span class="icon-pencil">&nbsp;</span></a>
                                    	<a href="<?=url('admin/storages/delete/'.$data[$i]['id'])?>" class="iconbtn"><span class="icon-trash">&nbsp;</span></a>
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
                        <form class="pure-form pure-form-stacked" 
                              action="<?=url('admin/storages/add')?>" 
                              method="POST" 
                              enctype="multipart/form-data">
                            <fieldset>
                                <div class="pure-control-group">
                                    <input name="name" type="text" placeholder="Nama Tempate Penyimpanan" class="pure-input-2-3" >
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