<?php
namespace Application\Core;

/**
 * Class Model
 * @package Application\Core
 */
class Model
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}