<?php

	class Asiakas extends BaseModel{
		public $id, $nimi, $osoite, $postinumero, $postipaikka, $puhelin, $email;

		public function __construct($attributes){
    		parent::__construct($attributes);
            $this->validators = array('validate_name');
  		}

		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Asiakas');
    		$query->execute();
    		$rows = $query->fetchAll();
    		$asiakkaat = array();

    		foreach ($rows as $row) {
    			$asiakkaat[] = new Asiakas(array(
    				'id' => $row['id'],
    				'nimi' => $row['nimi'],
    				'osoite' => $row['osoite'],
    				'postinumero' => $row['postinumero'],
    				'postipaikka' => $row['postipaikka'],
    				'puhelin' => $row['puhelin'],
    				'email' => $row['email']
    			));
    		}
    		return $asiakkaat;
		}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE id = :id LIMIT 1');
    		$query->execute(array('id' => $id));
    		$row = $query->fetch();

    		if ($row) {
    			$asiakas = new Asiakas(array(
    				'id' => $row['id'],
    				'nimi' => $row['nimi'],
    				'osoite' => $row['osoite'],
    				'postinumero' => $row['postinumero'],
    				'postipaikka' => $row['postipaikka'],
    				'puhelin' => $row['puhelin'],
    				'email' => $row['email']
    			));
    			return $asiakas;
    		}
    		return null;
		}

        public function save(){
            $query = DB::connection()->prepare('INSERT INTO Asiakas (nimi, osoite, postinumero, postipaikka, puhelin, email) VALUES (:nimi, :osoite, :postinumero, :postipaikka, :puhelin, :email) RETURNING id');
            $query->execute(array('nimi' => $this->nimi, 'osoite' => $this->osoite, 'postinumero' => $this->postinumero, 'postipaikka' => $this->postipaikka, 'puhelin' => $this->puhelin, 'email' => $this->email));
            $row = $query->fetch();
            $this->id = $row['id'];
        }

        public function validate_name(){
            $errors = array();
            if($this->nimi == '' || $this->nimi == null){
                $errors[] = 'Nimi ei saa olla tyhjä';
            }
            if(strlen($this->nimi) < 3){
                $errors[] = 'Nimen tulee olla vähintään 3 merkkiä';
            }
            return $errors;
        }
	}