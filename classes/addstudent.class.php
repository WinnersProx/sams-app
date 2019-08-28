<?php
require_once 'configs/database.php';
class AddStudent{

private $name;
private $rNumber;
private $class;
//connection to database initialisation;


public function __construct($name, $rNumber, $class){
	$this->name = $name;
	$this->rNumber = $rNumber;
	$this->class = $class;
	$this->db = connect();
}

//
public function checkStudent(){
	if(strlen($this->name) >= 5 && strlen($this->name) <= 15){
		if(strlen($this->rNumber) >= 6 && strlen($this->rNumber) <= 10){
			if(strlen($this->class) >= 2 && strlen($this->class) <= 6){
				$qr = $this->db->prepare('SELECT *FROM students WHERE roll_number = :roll_number');
				$qr->execute([     
					'roll_number' => $this->rNumber
				]);
				if($qr->rowCount() >=1){
					$result = $qr->fetch(PDO::FETCH_OBJ);
					if($result->roll_number != $this->rNumber){
						return 'Student added';
					}
					else{
						$status = 'The entered roll_number already exist please find another one';
						return $status;
					}

				}
				else{
					return 'Student added';
				}
				
				
			}
			else{
				$status = 'The class length must be between 2 and 6';
				return $status;

			}

		}
		else{
			$status = 'The roll number length must be between 1 and 6';
			return $status;
		}


	}
	else{
		$status = 'The username length must be between 5 and 15';
		return $status;
	}
}

public function insertStudent(){

	$q = $this->db->prepare("INSERT INTO students(student_name, roll_number, class) VALUES(:name_student, :roll_number, :class)");
	$q->execute([
		'name_student' => $this->name,
		'roll_number'   => $this->rNumber,
		'class'      => $this->class
	]);
}



}




