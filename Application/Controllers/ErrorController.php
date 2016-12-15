<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Models\ErrorModel;
use Application\Views\ErrorView;

/**
 * Class ErrorController
 *
 * @package Application\Controllers
 */
class ErrorController extends Controller
{
    /**
     * @param array $server
     * @param array $request
     * @param array $session
     */
    public function action(array $server, array $request, array $session)
    {
        (new ErrorView())->generate(((new ErrorModel())->buildData($request))->getData());
    }
}