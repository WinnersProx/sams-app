<?php


require_once 'classes/login.class.php';

if(isset($_POST['username'], $_POST['password'])){
	extract($_POST);
	$login = new Login($username, $password);

	$status = $login->checkLogin();
	if($status == 'checked'){
		header('Location:index.php?admin='.$_SESSION['admin']);
	}
}
	
	







?>