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
                <ul>
                    <li><a href="<?=url('admin/collections/')?>">Item List</a></li>
                    <li><a href="<?=url('admin/collections/add')?>">Add Item</a></li>
                </ul>
            </li>
            <li>
                <a href="<?=url('admin/artists/')?>">
                <span class="icon-books">&nbsp;</span> <span class="navName">Artists</span>
                </a>
                <ul>
                    <li><a href="<?=url('admin/artists/')?>">Artist list</a></li>
                    <li><a href="<?=url('admin/artists/add')?>">Add Item</a></li>
                </ul>
            </li>
            <li>
                <a href="<?=url('admin/curators/')?>">
                <span class="icon-books">&nbsp;</span> <span class="navName">Curators</span>
                </a>
                <ul>
                    <li><a href="<?=url('admin/curators/')?>">Curators list</a></li>
                    <li><a href="<?=url('admin/curators/add')?>">Add Item</a></li>
                </ul>
            </li>
            <li>
                <a href="<?=url('admin/users/')?>">
                <span class="icon-books">&nbsp;</span> <span class="navName">Users</span>
                </a>
               
            </li>
            <li>
                <a href="#">
                <span class="icon-cog">&nbsp;</span> <span class="navName">Setting</span>
                </a>
                <ul>
                    <li><a href="<?=url('admin/settings/admins')?>">Administrators</a></li>
                    <li><a href="<?=url('admin/settings/admins')?>">Exists Stats</a></li>
                    <li><a href="<?=url('admin/settings/admins')?>">Matrials</a></li>
                    <li><a href="<?=url('admin/settings/admins')?>">Obtained Way</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="collapse">
                <span class="icon-arrow-left2">&nbsp;</span> <span class="navName">Collapse Menu</span>
                </a>
            </li>
        </ul>
    </div>
</div><!-- end #sidebar -->