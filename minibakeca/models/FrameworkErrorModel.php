<?php

require_once(__SITE_PATH . "/models/Model.php");

class FrameworkErrorModel extends Model { 
     
    public function __construct($exception) {
        $this->data = $exception;
    }
} 

?>
