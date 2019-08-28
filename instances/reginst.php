<?php
require_once 'classes/registuser.class.php';

if(isset($_POST['username'], $_POST['a_password'], $_POST['class'])){
	extract($_POST);
	$regist = new Register($username, $a_password, $class);

	$status = $regist->checkStatus();
	if($status == 'Administrator added'){
		$regist->insertAdmin();
		header('location:login.php');
	}
}
	
	



