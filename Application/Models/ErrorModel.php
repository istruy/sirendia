<?php
namespace Application\Models;

use Application\Core\Config;
use Application\Core\Exceptions\ApplicationException;
use Application\Core\FileManager;
use Application\Core\Model;

/**
 * Class ErrorModel
 * @package Application\Models
 */
class ErrorModel extends Model
{
    /**
     * @param array $request
     * @return $this
     */
    public function buildData(array $request)
    {
        $this->data['errorMessage'] = $request['errorMessage'];
        return $this;
    }
}