<?php

	class Kohde extends BaseModel{
		public $id, $osoite, $aloitettu, $tila, $kuvaus, $katselu, $asiakas_id;

		public function __construct($attributes){
    		parent::__construct($attributes);
  		}

		public static function all(){
			$query = DB::connection()->prepare('SELECT Kohde.osoite, Kohde.aloitettu, Asiakas.nimi, Kohde.tila, MAX(Merkinta.paivays), Kohde.id FROM Asiakas, Merkinta, Kohde WHERE Kohde.id = Merkinta.kohde AND Kohde.asiakas_id = Asiakas.id');
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
	}