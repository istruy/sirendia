<?php
namespace Application\Views;

use Application\Core\View;

/**
 * Class MainView
 * @package Application\Views
 */
class IndexView extends View
{
    /**
     * @param array $data
     */
    public function generate(array $data)
    {
        echo $this->twig->render('index.html.twig', $data);
    }
}