<?php
if(pathHas('')){
    $dashboard = "class='active'";
}
?>
<div id="sidebar">
<div class="fakesidebar"></div>
    <div id="navbar">
        <ul class="sf-menu" id="navigation">
            <li>
                <a href="<?=url('admin/')?>" <?=$dashboard?>>
                <span class="icon-dashboard">&nbsp;</span> <span class="navName">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?=url('admin/collections/')?>">
                <span class="icon-books">&nbsp;</span> <span class="navName">Collections</span>
                </a>
               
            </li>
            <li>
                <a href="<?=url('admin/artists/')?>">
                <span class="icon-books">&nbsp;</span> <span class="navName">Artists</span>
                </a>
               
            </li>
            <li>
                <a href="<?=url('admin/curators/')?>">
                <span class="icon-books">&nbsp;</span> <span class="navName">Curators</span>
                </a>
               
            </li>
            <?php if(admin_has_credential_access()):?>
            <li>
                <a href="<?=url('admin/art-types/')?>">
                <span class="icon-books">&nbsp;</span> <span class="navName">Jenis Karya Seni</span>
                </a>
               
            </li>
            <li>
                <a href="#">
                <span class="icon-cog">&nbsp;</span> <span class="navName">Setting</span>
                </a>
                <ul>
                    <li><a href="<?=url('admin/users')?>">Managemen User</a></li>
                    <li><a href="<?=url('admin/conditions')?>">Kondisi Barang</a></li>
                    <li><a href="<?=url('admin/status')?>">Keberadaan Barang</a></li>
                    <li><a href="<?=url('admin/matrials')?>">Matrials</a></li>
                    <li><a href="<?=url('admin/metode')?>">Metode Perolehan</a></li>
                    <li><a href="<?=url('admin/storages')?>">Tempat Penyimpanan</a></li>
                </ul>
            </li>
            <?php endif;?>
            <li>
                <a href="javascript:void(0);" class="collapse">
                <span class="icon-arrow-left2">&nbsp;</span> <span class="navName">Collapse Menu</span>
                </a>
            </li>
        </ul>
    </div>
</div><!-- end #sidebar -->