<?php


	class Kayttaja extends BaseModel{
		public $id, $kayttaja, $salasana, $nimi;
		
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
    				'nimi' => $row['nimi']
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
    				'nimi' => $row['nimi']
    			));
    			return $kayttaja;
			}else{
			  return null;
			}
		}
	}