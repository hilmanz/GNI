<?php
$start = intval($_REQUEST['start']);
$limit = intval($_REQUEST['total']);
if($limit == 0){
    $limit = 10;
}


$total = get('total_rows');
$total_pages = ceil($total/$limit);
if($start < 0){
	$start = 0;
	$current_page = 0;
}else{
	$current_page = ceil($start / $limit)+1;	
}


$max_page = 28;
$min_page = 1;
if($current_page > 27 && $current_page <= $total_pages){
	$max_page = $current_page + 14;
	$min_page = $current_page - 14;
	
}
if($max_page > $total_pages){
	$max_page = $total_pages;
}
$params = get('params');

if($current_page > 1){
	$previous_page = $current_page-2;	
}else{
	$previous_page = $current_page-1;
}

?>
<?php if($total_pages > 0):?>
<div class="paging">
	<a href="?<?=$params?>&start=<?=($previous_page)*$limit?>">&laquo;</a>
	<?php for($i=$min_page;$i<=$max_page;$i++):?>
	<?php if($i==$current_page):?>
	<a href="?<?=$params?>&start=<?=($i-1)*$limit?>" class="current"><?=$i?></a>
	<?php else:?>
	<a href="?<?=$params?>&start=<?=($i-1)*$limit?>"><?=$i?></a>
	<?php endif;?>
	<?php endfor;?>
	<a href="?<?=$params?>&start=<?=($current_page)*$limit?>">&raquo;</a>
</div><!-- end .paging -->
<?php endif;?>