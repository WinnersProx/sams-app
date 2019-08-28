<?php

require_once 'classes/addstudent.class.php';

if(isset($_POST['studentName'], $_POST['rollN'], $_POST['class'])){
	extract($_POST);
	$Student = new AddStudent($studentName, $rollN, $class);
	$checkStudent = $Student->checkStudent();
	if($checkStudent == 'Student added'){
		$Student->insertStudent();
		header('Location:index.php?admin='.$_SESSION['admin']);
	}
	else{
		$status = $checkStudent;
	}
}
