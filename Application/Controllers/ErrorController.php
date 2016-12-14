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
     */
    public function action(array $server, array $request)
    {
        (new ErrorView())->generate(((new ErrorModel())->buildData($request))->getData());
    }
}