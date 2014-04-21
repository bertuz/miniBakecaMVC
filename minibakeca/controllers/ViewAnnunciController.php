<?php

class ViewAnnunciController extends Controller {

    public function view() {
    	// $this->model->setID($_GET['idAnnuncio']);
        if(!$this->model->fetch())
            throw new Exception("Problemi con il reperimento dei dati dal il database");
    }

    public function orderDate() {
        $desc = ($_GET['desc'] === "true")? true : false;
        
        $prova = $this->model->setOrder("date", $desc);

        $this->view();
    }

    public function defaultOp() {
    	$this->view();
    }
}

?>