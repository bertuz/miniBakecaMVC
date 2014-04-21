<?php

class AnnuncioData {
	public $ID;
	public $title;
	public $description;
	public $date;
	public $name;
	public $email;
	public $views;
	public $answers;
}

interface AnnuncioDAO {
	public function findByID($ID);
	public function save();
	public function update(AnnuncioData $annuncio);
	public function insertAnnuncio(AnnuncioData $annuncio);
}

?>