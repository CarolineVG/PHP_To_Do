<?php
class Database {
    // source: cursus school
    private static $conn;

     public static function connection() {
        // SET ROOT OF THE FILES
        if(!defined('__ROOT__')){
            define('__ROOT__', dirname(dirname(__FILE__)));
        }

        // REQUIRE SETTINGS.PHP
        require_once(__ROOT__.'/settings.php');

        // IF CONNECTION DOESNT EXIST YET -> MAKE NEW CONNECTION
        if( self::$conn == null ){
            self::$conn = new PDO("mysql:host=".$settings['host']."; dbname=".$settings['databaseName'] . ";", $settings['username'], $settings['password']);
                
            return self::$conn;
        // ELSE RETURN EXISTING CONNECTION 
        } else {
            return self::$conn;
        }
    }
}
?>