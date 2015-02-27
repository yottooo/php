<?php
namespace application;

/**
 * validate specialitie
 */
class Specialitie {

    private $name;

    public function __construct($name = '') {
        $this->name = $name;
    }

    /**
     * 
     * @param type $long if $abb is true return long name else short name
     * 
     */
    public function getName($long) {
        if ($long) {
            echo 'Информатика' . '<br>';
        } else {
            echo 'И';
        }
    }

}
