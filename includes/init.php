<?php
require('configs/database.php');
require('includes/functions.php');
require('includes/constants.php');
require('bootstrap/locale.php');



if(!empty($_COOKIE['pseudo']) && !empty($_COOKIE['id']) && !empty($_COOKIE['avatar'])){

	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
	$_SESSION['id'] = $_COOKIE['id'];
	$_SESSION['avatar'] = $_COOKIE['avatar'];
}
auto_login();



?>