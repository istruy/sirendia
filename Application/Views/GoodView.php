<?php
namespace Application\Views;

use Application\Core\View;

/**
 * Class GoodView
 * @package Application\Views
 */
class GoodView extends View
{
    /**
     * @param array $data
     */
    public function generate(array $data)
    {
        echo $this->twig->render('good.html.twig', $data);
    }
}