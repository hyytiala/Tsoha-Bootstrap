<?php

	
	class Merkinta extends BaseModel{
		public $paivays, $tunnit, $kuvaus, $kohde, $nimi;
		
		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public static function all($id){
			$query = DB::connection()->prepare('SELECT Merkinta.paivays, Merkinta.tunnit, Merkinta.kuvaus, Tyomies.nimi FROM Merkinta, Tyomies WHERE Merkinta.tyomies = Tyomies.id AND Merkinta.kohde = :id');
    		$query->execute(array('id' => $id));
    		$rows = $query->fetchAll();
    		$merkinnat = array();

    		foreach ($rows as $row) {
    			$merkinnat[] = new Merkinta(array(
    				'paivays' => $row['paivays'],
    				'tunnit' => $row['tunnit'],
    				'kuvaus' => $row['kuvaus'],
    				'nimi' => $row['nimi']
    			));
    		}
    		return $merkinnat;
		}

        public function save(){
            $query = DB::connection()->prepare('INSERT INTO Merkinta (tyomies, tunnit, kuvaus, kohde) VALUES (:nimi, :tunnit, :kuvaus, :kohde) RETURNING id');
            $query->execute(array('nimi' => $this->nimi, 'tunnit' => $this->tunnit, 'kuvaus' => $this->kuvaus, 'kohde' => $this->kohde));
    }
	}