<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Models\IndexModel;
use Application\Views\IndexView;

/**
 * Class MainController
 * @package Application\Controllers
 */
class IndexController extends Controller
{
    /**
     * @param array $server
     * @param array $request
     * @param array $session
     */
    public function action(array $server, array $request, array $session)
    {
        (new IndexView())->generate(((new IndexModel())->buildData($session))->getData());
    }
}