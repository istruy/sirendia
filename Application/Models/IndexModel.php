<?php
namespace Application\Models;

use Application\Core\Config;
use Application\Core\FileManager;
use Application\Core\Model;

/**
 * Class MainModel
 * @package Application\Models
 */
class IndexModel extends Model
{
    /**
     * @return $this
     */
    public function buildData()
    {
        return $this;
    }
}