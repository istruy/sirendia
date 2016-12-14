<?php
namespace Application\Views;

use Application\Core\View;

/**
 * Class ErrorController
 * @package Application\Views
 */
class ErrorView extends View
{
    /**
     * @param array $data
     */
    public function generate(array $data)
    {
        echo $this->twig->render('error.html.twig', $data);
    }
}