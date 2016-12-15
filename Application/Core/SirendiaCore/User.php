<?php
namespace Application\Core\SirendiaCore;

class User
{
    private static $user;
    private static $id;

    public static function getId()
    {
        if (!empty($_SESSION['id'])) {
            self::$id = $_SESSION['id'];
            return self::$id;
        } else {
            return false;
        }
    }

    /**
     * Получает информацию о пользователе
     *
     * @access public
     * @return array
     */
    public static function getUser()
    {
        if (self::getId()) {
            self::$user = MyDB::run("SELECT * FROM user WHERE id=" . self::$id);

            return self::$user;
        } else {
            return false;
        }

    }

    /**
     * Получает информацию о пользователе по ключу
     *
     * @access public
     * @return mixed
     */
    public static function get($key)
    {
        self::getUser();
        if (array_key_exists($key, self::$user)) {
            return self::$user[$key];
        }

        return false;
    }
}
