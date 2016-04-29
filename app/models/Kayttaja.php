<?php


	class Kayttaja extends BaseModel{
		public $id, $kayttaja, $salasana, $nimi, $admin;
		
		function __construct($attributes){
			parent::__construct($attributes);
		}

		public static function authenticate($kayttaja, $salasana){
			$query = DB::connection()->prepare('SELECT * FROM Tyomies WHERE kayttaja = :kayttaja AND salasana = :salasana LIMIT 1');
			$query->execute(array('kayttaja' => $kayttaja, 'salasana' => $salasana));
			$row = $query->fetch();
			if($row){
			  $kayttaja = new Kayttaja(array(
    				'id' => $row['id'],
    				'kayttaja' => $row['kayttaja'],
    				'salasana' => $row['salasana'],
    				'nimi' => $row['nimi'],
    				'admin' => $row['admin']
    			));
    			return $kayttaja;
    		}else{
			  return null;
			}
		}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Tyomies WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();
			if($row){
			  $kayttaja = new Kayttaja(array(
    				'id' => $row['id'],
    				'kayttaja' => $row['kayttaja'],
    				'nimi' => $row['nimi'],
    				'admin' => $row['admin'],
    				'salasana' => $row['salasana']
    			));
    			return $kayttaja;
			}else{
			  return null;
			}
		}

		public function validate_salasana(){
            $errors = array();
            if($this->salasana == '' || $this->salasana == null || strlen($this->salasana) < 5){
                $errors[] = 'Salasanan tulee olla vähintään 5 merkkiä';
            }
            return $errors;
        }

        public static function authenticate_password($password, $id){
        	$sala = Kayttaja::find($id);
        	if ($sala->salasana == $password){
        		return true;
        	}else{
        		return false;
        	}
        }

        public function update_password(){
            $query = DB::connection()->prepare('UPDATE Tyomies SET salasana = :salasana WHERE id = :id');
            $query->execute(array('salasana' => $this->salasana, 'id' => $this->id));
            $row = $query->fetch();
        }

        public function reset_password(){
        	$salasana = 'salasana';
            $query = DB::connection()->prepare('UPDATE Tyomies SET salasana = :salasana WHERE id = :id');
            $query->execute(array('id' => $this->id, 'salasana' => $salasana));
            $row = $query->fetch();
        }
	}