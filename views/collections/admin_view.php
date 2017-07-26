<?php
$rs = get('rs');

?>
<div class="page_section" id="dashboard-page">
    <div id="container">

        <div class="titlebox">
            <h2 class="fl"><span class="icon-books">&nbsp;</span> Koleksi</h2>
        </div><!-- end .titlebox -->
        <div class="content">
        	<div class="row">
            	<div class="col1">
                    <table width="100%" class="table">
                        <tr>
                            <td colspan="4">
                               <a class="showPopup" href="#"><img src="<?=url('content/'.$rs['image'])?>"/></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <?=$rs['name']?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <?=$rs['descr']?>
                            </td>
                        </tr>
                        <tr>
                            <td><h4>Seniman</h4><?=$rs['artist_name']?></td>
                            <td><h4>Tahun </h4><?=date("Y",strtotime($rs['create_date']))?></td>
                            <td><h4>Matrial</h4><?=$rs['matrial']?></td>
                            <td><h4>Ukuran </h4><?=$rs['size']?></td>
                        </tr>
                        <tr>
                            <td><h4>No. Inventory </h4><?=$rs['invent_no']?></td>
                            <td><h4>No. Registrasi </h4><?=$rs['no_reg']?></td>
                            <td><h4>No. Slide </h4><?=$rs['no_slide']?></td>
                            <td><h4>Jenis Karya</h4><?=$rs['jenis_karya']?></td>
                        </tr>
                        <tr>
                            <td><h4>Kurator </h4><?=$rs['curator']?></td>
                            <td><h4>Kondisi</h4><?=$rs['kondisi']?></td>
                            <td><h4>Keberadaan Barang</h4><?=$rs['keberadaan']?></td>
                            <td><h4>Storage</h4><?=$rs['storage_name']?></td>

                        </tr>
                         <tr>
                            <td colspan="1"><h4>Cara Perolehan</h4><?=$rs['cara']?></td>
                            <td colspan="3"><h4>Dari</h4><?=$rs['obtain']?></td>
                            
                            
                        </tr>
                    </table>
                   <a href="javascript:history.go(-1)" class="button2">Kembali</a>
                    
                </div><!-- end .col1 -->
            </div><!-- end .row -->
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->
