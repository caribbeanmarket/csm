<?php require 'C:\wamp\www\csm\app\views\header.php'; ?>

<?php require 'C:\wamp\www\csm\app\views\menu.php'; ?>

<?php 
	if(!empty($data["reportType"])){
		include 'C:\wamp\www\csm\app\views\reports/' . $data["reportType"] . '.php';
	}
?>

<?php require 'C:\wamp\www\csm\app\views\footer.php'; ?>