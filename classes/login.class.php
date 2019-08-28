<?php

include 'configs/database.php';

class Login{

	private $name;
	private $password;

	public function __construct($name, $password){

		$this->name = $name;
		$this->password = $password;
		$this->db = connect();


	}
	public function checkLogin(){
		$q = $this->db->prepare("SELECT *FROM admin WHERE name_admin = :name_admin");
		$q->execute([
			'name_admin' => $this->name
		]);
		$count = $q->rowCount();
		if($count == 1){
			$user = $q->fetch();
			if(password_verify($this->password, $user['password'])){
				$_SESSION['admin'] = $this->name;
				return 'checked';
			}
			else{
				$status = 'No matching between username and password';
				return $status;
			}
		}
		else{
			$status = 'You entered  a wrong username ';
			return $status;

		}
		

	}



}














