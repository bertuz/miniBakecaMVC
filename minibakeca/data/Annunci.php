<?php

class AnnunciData {
	/**
	 * @type AnnuncioData[]
	*/
	public $annunci = array();
}

interface AnnunciDAO {
	/**
	 * @return AnnunciData
	*/
	public function getAnnunci($orderBy, $desc);
}

?>