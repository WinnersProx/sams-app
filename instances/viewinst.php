<?php

require_once 'classes/index.class.php';

if(!isset($_SESSION['admin'])){
	header('Location:login.php');

}
else{
	$t_year = date('Y');
	$t_month = date('m');
	$t_day = date('d')-1;
	$t_date = $t_year.'-'.$t_month.'-'.$t_day;
	$db = connect();

	$attendance = new Attendance();
	$get_date_list = $attendance->getDateList();
	
	// Now for the attendance // For the attendance now for it now now now

	

	
}
