<?php
namespace application;
class Connect {

    private static $instance = NULL;
    private static  $user = 'root';
    private static $password = ' ';

    private function __construct() {
        
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new \PDO('mysql:host=localhost;dbname=students;charset=utf8','root', '');
        }
        return self::$instance;
       
    }
    
   


}
