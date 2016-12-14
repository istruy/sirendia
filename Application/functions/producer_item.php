<?php
require_once("/var/www/html/config/core.php");

class Producer {
    private static $pr_item;
    private static $id;
    private static $pr_id;

    public static function getID() {
        self::$id = MyDB::run("SELECT id FROM producer_item");
        return self::$pr_item;
    }

    public static function getProducerItem(){
        If 
        self::$pr_item = MyDB::run("SELECT * FROM producer_item WHERE id=".self::$id);
        return self::$pr_item;
    }

    public static function GET($key){
        self::getProducer();
        if (array_key_exists($key,self::$producer)){
            return self::$producer[$key];
        }
        return false;
    }
    public static function SetProducer($id) {
        if ((int)$id > 0) {
            self::$pr_id = (int)$id;
            return true;
        } return false;
    }
}
?>