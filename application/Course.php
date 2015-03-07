<?php
namespace application;

/*
 * validate course data
 */

class Course {

    private $name;

    public function __construct($name='') {
        $this->name = $name;
    }

    public function getName() {
        echo 'Трети Курс' . '<br>';
    }
    public function add(){
        
        echo 'add '.htmlentities($this->name);
    }

    
    public function delete(){
        echo 'delete '.$this->name;
    }

}
