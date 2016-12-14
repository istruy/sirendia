<?php
namespace Application\Core;

use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Class View
 * @package Application\Views
 */
class View
{
    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(Config::getInstance()->getTemplateFolder());
        $this->twig = new Twig_Environment($loader, array(
            'cache' => Config::getInstance()->getCacheForTemplateFolder(),
            'debug' => true
        ));
    }
}