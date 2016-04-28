<?php

	class Kohde extends BaseModel{
		public $id, $osoite, $aloitettu, $tila, $kuvaus, $katselu, $nimi, $viimeisin;

		public function __construct($attributes){
    		parent::__construct($attributes);
            $this->validators = array('validate_kohde');
  		}

		public static function all(){
			$query = DB::connection()->prepare('SELECT Kohde.osoite, Kohde.aloitettu, Asiakas.nimi, Kohde.tila, MAX(Merkinta.paivays) AS viimeisin, Kohde.id FROM Kohde LEFT JOIN Asiakas ON Kohde.asiakas_id = Asiakas.id LEFT JOIN Merkinta ON Merkinta.kohde = Kohde.id GROUP BY Kohde.id, Kohde.osoite, Kohde.aloitettu, Kohde.tila,  Asiakas.nimi');
    		$query->execute();
    		$rows = $query->fetchAll();
    		$kohteet = array();

    		foreach ($rows as $row) {
    			$kohteet[] = new Kohde(array(
                    'id' => $row['id'],
                    'osoite' => $row['osoite'],
                    'aloitettu' => $row['aloitettu'],
    				'tila' => $row['tila'],
    				'nimi' => $row['nimi'],
    				'viimeisin' => $row['viimeisin'],
    			));
    		}
    		return $kohteet;
		}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT Kohde.id, Kohde.osoite, Kohde.aloitettu, Kohde.tila, Kohde.kuvaus, Kohde.katselu, Asiakas.nimi FROM Kohde, Asiakas WHERE Asiakas.id = Kohde.asiakas_id AND Kohde.id = :id LIMIT 1');
    		$query->execute(array('id' => $id));
    		$row = $query->fetch();

    		if ($row) {
    			$kohde = new Kohde(array(
    				'id' => $row['id'],
                    'osoite' => $row['osoite'],
                    'aloitettu' => $row['aloitettu'],
                    'tila' => $row['tila'],
                    'kuvaus' => $row['kuvaus'],
                    'katselu' => $row['katselu'],
                    'nimi' => $row['nimi']
    			));
    			return $kohde;
    		}
    		return null;
		}

        public function save(){
            $query = DB::connection()->prepare('INSERT INTO Kohde (osoite, aloitettu, kuvaus, katselu, asiakas_id, tila) VALUES (:osoite, :aloitettu, :kuvaus, :katselu, :nimi, :tila) RETURNING id');
            $query->execute(array('osoite' => $this->osoite, 'aloitettu' => $this->aloitettu, 'kuvaus' => $this->kuvaus, 'katselu' => $this->katselu, 'nimi' => $this->nimi, 'tila' => 'kesken'));
            $row = $query->fetch();
            $this->id = $row['id'];
        }

        public static function asiakas($id){
            $query = DB::connection()->prepare('SELECT COUNT(id) FROM Kohde WHERE asiakas_id = :id');
            $query->execute(array('id' => $this->id));
            $row = $query->fetch();
            $nro = $row['count'];
            return $nro;
        }

        public function katselu(){
            return $this->katselu;
        }

        public function validate_kohde(){
            $errors = array();
            if($this->osoite == '' || $this->osoite == null){
                $errors[] = 'Osoite ei saa olla tyhjä';
            }
            if($this->aloitettu == '' || $this->aloitettu == null){
                $errors[] = 'Päivämäärä ei saa olla tyhjä';
            }
            if($this->kuvaus == '' || $this->kuvaus == null){
                $errors[] = 'Kuvaus ei saa olla tyhjä';
            }
            if($this->katselu == null){
                $errors[] = 'Valitse kohteen katseluoikeus';
            }
            return $errors;
        }
	}