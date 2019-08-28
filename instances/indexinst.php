<?php

require_once 'classes/index.class.php';

if(!isset($_SESSION['admin'])){
	header('Location:login.php');

}
else{
	//$t_year = date('Y');
	//$t_month = date('m');
	//$t_day = date('d')-1;
	//$t_date = $t_year.'-'.$t_month.'-'.$t_day;
	$t_date = date("Y-m-d");
	$db = connect();
	$q = $db->query("SELECT *FROM students WHERE class = 'Year 2' ");
	

	$attendance = new Attendance();
	// Now for the attendance // For the attendance now for it now now now
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		//$roll = $_POST['roll'];
		if(!empty($_POST['attend'])){
			extract($_POST);
			$insertAttend = $attendance->insertAttendance($t_date, $attend);
		}
		else{
			$status = 'A roll number is missing';
		}
		

	}
	if(isset($insertAttend)){
		$status = $insertAttend;
	}
	

	
}
