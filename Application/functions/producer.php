<?php
require_once("/var/www/html/config/core.php");

class Producer {
    private static $producer;
    private static $id;

    public static function getID() {
        if (!empty($_GET['producer'])) {
            self::$id = $_GET['producer'];
            return self::$id;
        } else return false;
    }

    public static function getProducer(){
        self::getID();
        self::$producer = MyDB::run("SELECT * FROM producer WHERE id=".self::$id);
        return self::$producer;
    }

    public static function GET($key){
        self::getProducer();
        if (array_key_exists($key,self::$producer)){
            return self::$producer[$key];
        }
        return false;
    }
}
?>