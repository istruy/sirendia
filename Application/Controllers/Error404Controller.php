<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Views\Error404View;

/**
 * Class Error404Controller
 * @package Application\Controllers
 */
class Error404Controller extends Controller
{
    /**
     * @param array $server
     * @param array $request
     * @param array $session
     */
    public function action(array $server, array $request, array $session)
    {
        (new Error404View())->generate();
    }
}