<?php
namespace Application\Models;

use Application\Core\Config;
use Application\Core\Database;
use Application\Core\FileManager;
use Application\Core\Model;

/**
 * Class MainModel
 *
 * @package Application\Models
 */
class IndexModel extends Model
{
    /**
     * @param array $session
     * @return $this
     */
    public function buildData(array $session)
    {
        $this->data['isLogin'] = $this->isUserLoginIn($session);
        if ($this->data['isLogin']) {
            var_dump(Database::getInstance()->query(
                "SELECT * FROM user"
            ));
        }

        return $this;
    }

    /**
     * @param $session
     * @return bool
     */
    private function isUserLoginIn(array $session): bool
    {
        return empty($session['login']);
    }
}