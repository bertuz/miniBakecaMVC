<?php

require_once(__SITE_PATH . '/data/DAOFactory.php');

abstract class Model {
	protected $data;
    
    public function isFetched() {
        return !is_null($this->data);
    }

    public function getData() {
        $reflection;

        if(!is_null($this->data)) {
            if(method_exists($this->data, "__clone")) {
                $reflection = new ReflectionMethod($this->data, "__clone");
                
                if(! $reflection->isPublic())
                    return $this->data;
            }
            
            return clone $this->data;
        }
        else
            return null;
    }
}

?>