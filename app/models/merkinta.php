<?php

	
	class Merkinta extends BaseModel{
		public $id, $paivays, $tunnit, $kuvaus, $kohde, $nimi, $tyomies;
		
		public function __construct($attributes){
			parent::__construct($attributes);
            $this->validators = array('validate_merkinta');
		}

		public static function all($id){
			$query = DB::connection()->prepare('SELECT Merkinta.id, Merkinta.paivays, Merkinta.tunnit, Merkinta.kuvaus, Tyomies.nimi FROM Merkinta, Tyomies WHERE Merkinta.tyomies = Tyomies.id AND Merkinta.kohde = :id ORDER BY Merkinta.id DESC');
    		$query->execute(array('id' => $id));
    		$rows = $query->fetchAll();
    		$merkinnat = array();

    		foreach ($rows as $row) {
    			$merkinnat[] = new Merkinta(array(
                    'id' => $row['id'],
    				'paivays' => $row['paivays'],
    				'tunnit' => $row['tunnit'],
    				'kuvaus' => $row['kuvaus'],
    				'nimi' => $row['nimi']
    			));
    		}
    		return $merkinnat;
		}

        public static function find($id){
            $query = DB::connection()->prepare('SELECT * FROM Merkinta WHERE id = :id LIMIT 1');
            $query->execute(array('id' => $id));
            $row = $query->fetch();

            if ($row) {
                    $merkinta = new Merkinta(array(
                    'paivays' => $row['paivays'],
                    'tunnit' => $row['tunnit'],
                    'kuvaus' => $row['kuvaus'],
                    'id' => $row['id'],
                    'kohde' => $row['kohde'],
                    'tyomies' => $row['tyomies']
                ));
                return $merkinta;
            }
            return null;
        }

        public function save(){
            $query = DB::connection()->prepare('INSERT INTO Merkinta (tyomies, tunnit, kuvaus, kohde) VALUES (:nimi, :tunnit, :kuvaus, :kohde) RETURNING id');
            $query->execute(array('nimi' => $this->nimi, 'tunnit' => $this->tunnit, 'kuvaus' => $this->kuvaus, 'kohde' => $this->kohde));
        }

        public function validate_merkinta(){
            $errors = array();
            if($this->kuvaus == '' || $this->kuvaus == null){
                $errors[] = 'Kuvaus ei saa olla tyhjä';
            }
            if($this->tunnit == '' || $this->tunnit == null){
                $errors[] = 'Tunnit ei saa olla tyhjä';
            }
            return $errors;
        }

        public function destroy(){
            $query = DB::connection()->prepare('DELETE FROM Merkinta WHERE id = :id');
            $query->execute(array('id' => $this->id));
            $row = $query->fetch();
        }
	}