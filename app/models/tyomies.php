<?php

	
	class Tyomies extends BaseModel{
		public $id, $nimi, $kayttaja, $salasana, $puhelin, $tunnit;
		
		public function __construct($attributes){
			parent::__construct($attributes);
            $this->validators = array('validate_tyomies');
		}

		public static function all(){
			$query = DB::connection()->prepare('SELECT id, nimi, puhelin, tunnit FROM Tyomies');
    		$query->execute();
    		$rows = $query->fetchAll();
    		$tyomiehet = array();

    		foreach ($rows as $row) {
    			$tyomiehet[] = new Tyomies(array(
    				'id' => $row['id'],
    				'nimi' => $row['nimi'],
    				'puhelin' => $row['puhelin'],
    				'tunnit' => $row['tunnit']
    			));
    		}
    		return $tyomiehet;
		}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT id, nimi, puhelin, tunnit, kayttaja FROM Tyomies WHERE id = :id LIMIT 1');
    		$query->execute(array('id' => $id));
    		$row = $query->fetch();

    		if ($row) {
    			$tyomies = new Tyomies(array(
    				'id' => $row['id'],
    				'nimi' => $row['nimi'],
    				'puhelin' => $row['puhelin'],
    				'tunnit' => $row['tunnit'],
                    'kayttaja' => $row['kayttaja']
    			));
    			return $tyomies;
    		}
    		return null;
		}

        public function save(){
            $query = DB::connection()->prepare('INSERT INTO Tyomies (nimi, kayttaja, puhelin, salasana) VALUES (:nimi, :kayttaja, :puhelin, :salasana) RETURNING id');
            $query->execute(array('nimi' => $this->nimi, 'kayttaja' => $this->kayttaja, 'puhelin' => $this->puhelin, 'salasana' => $this->salasana));
        }

        public function update(){
            $query = DB::connection()->prepare('UPDATE Tyomies SET nimi = :nimi, kayttaja = :kayttaja, puhelin = :puhelin WHERE id = :id');
            $query->execute(array('nimi' => $this->nimi, 'kayttaja' => $this->kayttaja, 'puhelin' => $this->puhelin, 'id' => $this->id));
            $row = $query->fetch();
        }

        public function validate_tyomies(){
            $errors = array();
            if($this->nimi == '' || $this->nimi == null || strlen($this->nimi) < 3){
                $errors[] = 'Nimen tulee olla vähintään 3 merkkiä';
            }
            if($this->puhelin == '' || $this->puhelin == null){
                $errors[] = 'Puhelinumero ei saa olla tyhjä';
            }
            if($this->kayttaja == '' || $this->kayttaja == null || strlen($this->kayttaja) < 3){
                $errors[] = 'Käyttäjänimen tulee olla vähintään 3 merkkiä';
            }
            return $errors;
        }

        public function validate_salasana(){
            $errors = array();
            if($this->salasana == '' || $this->salasana == null || strlen($this->salasana) < 5){
                $errors[] = 'Salasanan tulee olla vähintään 5 merkkiä';
            }
            return $errors;
        }
}