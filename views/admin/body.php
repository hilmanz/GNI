<?php if(isAdminLogin()):?>

<body>
	<div id="body">
    <div id="page">

		<?php include("top.php"); ?> 
        <?php include("sidebar.php"); ?> 
        <div id="thecontent">
			<?=$content?>		
      	</div>
<?php else:?>

<body id="login-page">
<div id="body">
    <div id="page">
<?=$content?>

<?php endif;?>