<?php

class InsAnnuncioController extends Controller {

    public function save() {
        $annuncio = new AnnuncioData();

        $annuncio->title = $_POST['title'];
        $annuncio->description = $_POST['description'];
        $annuncio->name = $_POST['name'];
        $annuncio->email = $_POST['email'];
        $annuncio->date = $_POST['date'];

        $this->model->insert($annuncio);
    }

    public function defaultOp() {
        //No op
    }
}

?>