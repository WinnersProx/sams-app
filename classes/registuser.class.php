<?php

require_once 'configs/database.php';

class Register{

	private $name;
	private $password;
	private $class;
	//connection to database initialisation;
	

	public function __construct($name, $password, $class){
		$this->name = $name;
		$this->password = $password;
		$this->class = $class;
		$this->db = connect();
	}

	//
	public function checkStatus(){
		if(strlen($this->name) >= 5 && strlen($this->name) <= 15){
			if(strlen($this->password) >= 9 && strlen($this->password) <= 13){
				if(strlen($this->class) >= 2 && strlen($this->class) <= 6){
					$chk = $this->db->query('SELECT *FROM admin');
					if($chk->rowCount() >=1){
						$result = $chk->fetch(PDO::FETCH_OBJ);
						if($result->name_admin != $this->name){
							return 'Administrator added';
						}
						else{
							$status = 'The entered name already exist please find another one';
							return $status;
						}

					}
					else{
						return 'Administrator added';
					}
					
					
				}
				else{
					$status = 'The class length must be between 2 and 6';
					return $status;

				}

			}
			else{
				$status = 'The password must be between 9 and 13';
				return $status;
			}


		}
		else{
			$status = 'The username length must be between 5 and 15';
			return $status;
		}
	}

	public function insertAdmin(){

		$q = $this->db->prepare("INSERT INTO admin(name_admin, password, class) VALUES(:name_admin, :password, :class)");
		$q->execute([
			'name_admin' => $this->name,
			'password'   => password_hash($this->password,PASSWORD_BCRYPT),
			'class'      => $this->class
		]);
	}



}














