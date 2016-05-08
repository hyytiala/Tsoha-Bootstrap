<?php

    class Kohde extends BaseModel{
        public $id, $osoite, $aloitettu, $tila, $kuvaus, $katselu, $nimi, $viimeisin, $asiakas;

        public function __construct($attributes){
            parent::__construct($attributes);
            $this->validators = array('validate_kohde');
        }

        public static function all(){
            $query = DB::connection()->prepare('SELECT Kohde.osoite, Kohde.aloitettu, Asiakas.nimi, Kohde.tila, MAX(Merkinta.paivays) AS viimeisin, Kohde.id FROM Kohde LEFT JOIN Asiakas ON Kohde.asiakas_id = Asiakas.id LEFT JOIN Merkinta ON Merkinta.kohde = Kohde.id GROUP BY Kohde.id, Kohde.osoite, Kohde.aloitettu, Kohde.tila,  Asiakas.nimi ORDER BY Kohde.tila');
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
            $query = DB::connection()->prepare('SELECT Kohde.id, Kohde.osoite, Kohde.aloitettu, Kohde.tila, Kohde.kuvaus, Kohde.katselu, Asiakas.nimi, Kohde.asiakas_id FROM Kohde, Asiakas WHERE Asiakas.id = Kohde.asiakas_id AND Kohde.id = :id LIMIT 1');
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
                    'nimi' => $row['nimi'],
                    'asiakas' => $row['asiakas_id']
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

        public function update(){
            $query = DB::connection()->prepare('UPDATE Kohde SET asiakas_id = :nimi, osoite = :osoite, tila = :tila, aloitettu = :aloitettu, kuvaus = :kuvaus, katselu = :katselu WHERE id = :id');
            $query->execute(array('nimi' => $this->nimi, 'osoite' => $this->osoite, 'tila' => $this->tila, 'aloitettu' => $this->aloitettu, 'kuvaus' => $this->kuvaus, 'katselu' => $this->katselu, 'id' => $this->id));
            $row = $query->fetch();
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
            if(strlen($this->osoite) > 100){
                $errors[] = 'Osoitteen maksimipituus on 100 merkkiä';
            }
            if(strlen($this->kuvaus) > 200){
                $errors[] = 'Kuvauksen maksimipituus on 200 merkkiä';
            }
            return $errors;
        }

        public function poista_merkinnat(){
            $query = DB::connection()->prepare('DELETE FROM Merkinta WHERE kohde = :id');
            $query->execute(array('id' => $this->id));
            $row = $query->fetch();
        }

        public function destroy(){
            $query = DB::connection()->prepare('DELETE FROM Kohde WHERE id = :id');
            $query->execute(array('id' => $this->id));
            $row = $query->fetch();
        }
    }