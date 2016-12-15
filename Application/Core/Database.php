<?php
namespace Application\Core;

use Application\Core\Exceptions\ApplicationException;

/**
 * Class Database
 *
 * @package Application\Core
 */
class Database
{
    /**
     * @var Database
     */
    private static $instance;
    private $connection;


    public static function init(string $host, string $user, string $password, string $dataBaseName)
    {
        static::$instance = new self();
        static::$instance->connection = static::$instance->createConnection($host, $user, $password, $dataBaseName);
    }

    /**
     * @return Database
     * @throws ApplicationException
     */
    public static function getInstance(): Database
    {
        if (static::$instance === null) {
            throw new ApplicationException("Объект 'Database' не инициализирован! ");
        }

        return static::$instance;
    }

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $dataBaseName
     * @return \mysqli
     */
    private function createConnection(string $host, string $user, string $password, string $dataBaseName): \mysqli
    {
        return mysqli_connect($host, $user, $password, $dataBaseName);
    }

    /**
     * @param string $query
     * @return array|null
     */
    public function query(string $query)
    {
        return mysqli_fetch_all(mysqli_query($this->connection, $query));
    }
}