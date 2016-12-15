<?php
use Application\Application;

include __DIR__ . '/../vendor/autoload.php';

Application::startSession();
Application::launch($_SERVER, $_REQUEST, $_SESSION);