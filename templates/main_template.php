<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<?php 
if($list_view){
	include('view-list.php');
}
//if($page_view){
else{
	include('view-page.php');
}
?>
<?php include('footer.php'); ?>