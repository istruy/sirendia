<?php

use Application\Application;

include __DIR__ . '/../vendor/autoload.php';

Application::launch($_SERVER,$_REQUEST);