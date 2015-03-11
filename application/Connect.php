<?php
namespace application;
class Connect {

    private static $instance = NULL;
    private static  $user = 'root';
    private static $password ="qwerty";

    private function __construct() {
        
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new \PDO('mysql:host=localhost;dbname=students;charset=utf8',self::$user, self::$password);
        }
        return self::$instance;
       
    }
    
   


}
