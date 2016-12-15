<?php
namespace Application\Views;

use Application\Core\View;

/**
 * Class Error404View
 * @package Application\Views
 */
class Error404View extends View
{
    public function generate()
    {
        echo $this->twig->render("error.html.twig");
    }
}