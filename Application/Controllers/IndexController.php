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
     */
    public function action(array $server, array $request)
    {
        (new IndexView())->generate(((new IndexModel())->buildData())->getData());
    }
}