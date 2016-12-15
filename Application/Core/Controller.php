<?php
namespace Application\Core;

/**
 * Class Controller
 * @package Application\Controllers
 */
abstract class Controller
{
    /**
     * @param array $server
     * @param array $request
     * @param array $session
     * @return
     */
    abstract public function action(array $server, array $request, array $session);
}