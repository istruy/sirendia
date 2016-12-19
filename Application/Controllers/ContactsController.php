<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Models\ErrorModel;
use Application\Views\ErrorView;

/**
 * Class ContactsController
 *
 * @package Application\Controllers
 */
class ContactsController extends Controller
{
    /**
     * @param array $server
     * @param array $request
     * @param array $session
     */
    public function action(array $server, array $request, array $session)
    {
        echo "Контакты";
    }
}