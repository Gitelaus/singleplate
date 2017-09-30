<?php
    
class Controller{

    var $routes = "";

    public function __construct($method, $arguments){
        if(method_exists($this, $method)){
            $this->$method($arguments);
        }else{
            $this->viewDefault($arguments);
        }
    }

}

?>