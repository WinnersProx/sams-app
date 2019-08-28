<?php
require_once 'configs/database.php';
class Attendance{

private $attend;
private $rNumber;
private $dated;
//connection to database initialisation;


public function __construct(){
	$this->db = connect();
}


public function insertAttendance($dated, $attend = []){
	$q = $this->db->query("SELECT DISTINCT dated FROM attendance");
	//fetch now
	while($result = $q->fetch(PDO::FETCH_ASSOC)){
		$f_date = $result['dated'];
		if($dated == $f_date){
			$status = "Please attendance just done for today!";
			return $status;
		}
	}
	$qr = $this->db->query("SELECT roll_number FROM students");
	$nbr = $qr->rowCount();
	//var_dump($nbr);
	if($attend < $nbr){
		$status = 'Some roll numbers are missing please!';
		return $status;
	}
	foreach ($attend as $att_key => $att_val) {
		
		if($att_val== 'present'){
			$att_q = $this->db->prepare("INSERT INTO attendance(roll, attend,dated) VALUES(:roll, :attend, NOW())");
			$att_q->execute([
				'roll' => $att_key, 
				'attend' => 'present'
			]);

		}
		else if($att_val == 'absent'){
			$att_q = $this->db->prepare("INSERT INTO attendance(roll, attend,dated) VALUES(:roll, :attend,NOW())");
			$att_q->execute([
				'roll' => $att_key,
				'attend' => 'absent'
			]);

		}
		else if($att_val == ''){
			$status = 'A roll number is missing please try again';
			return $status;
		}
		
		
	}
	if($att_q){
		$status = 'Attendance done successfully';
		return $status;
	}
	



	
	
}
public function updateAttendance($dated, $attend = []){
	foreach ($attend as $att_key => $att_val) {
		if($att_val== 'present'){
			$att_q = $this->db->prepare("UPDATE attendance SET attend =:attend WHERE roll =:roll AND dated = :dated");
			$att_q->execute([ 
				'attend' => 'present',
				'dated' => $dated,
				'roll' => $att_key
			]);

		}
		else if($att_val == 'absent'){
			$att_q = $this->db->prepare("UPDATE attendance SET attend =:attend WHERE roll =:roll AND dated = :dated");
			$att_q->execute([ 
				'attend' => 'absent',
				'dated' => $dated,
				'roll' => $att_key
			]);

		}

		
	}
	if($att_q){
		$status = 'Attendance data updated successfully';
		return $status;

	}
	else{
		$status = 'Something went wrong! attendance not updated';
		return $status;
	}

}
public function getDateList(){
	$q = $this->db->query("SELECT DISTINCT dated FROM attendance");
	return $q;

}
public function get_date_report($date){
	$q = $this->db->prepare("SELECT *FROM attendance WHERE dated =:dated");
	$q->execute([
		'dated' => $date
	]);
	return $q;
}

}


