<?php

	
	class Tyomies extends BaseModel{
		public $id, $nimi, $kayttaja, $salasana, $puhelin, $tunnit;
		
		public function __construct($attributes){
			parent::__construct($attributes);
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
			$query = DB::connection()->prepare('SELECT id, nimi, puhelin, tunnit FROM Tyomies WHERE id = :id LIMIT 1');
    		$query->execute(array('id' => $id));
    		$row = $query->fetch();

    		if ($row) {
    			$tyomies = new Tyomies(array(
    				'id' => $row['id'],
    				'nimi' => $row['nimi'],
    				'puhelin' => $row['puhelin'],
    				'tunnit' => $row['tunnit']
    			));
    			return $tyomies;
    		}
    		return null;
		}

        public function save(){
            $query = DB::connection()->prepare('INSERT INTO Tyomies (nimi, kayttaja, puhelin, salasana) VALUES (:nimi, :kayttaja, :puhelin, :salasana) RETURNING id');
            $query->execute(array('nimi' => $this->nimi, 'kayttaja' => $this->kayttaja, 'puhelin' => $this->puhelin, 'salasana' => $this->salasana));
	}
}