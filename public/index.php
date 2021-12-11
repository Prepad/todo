<?php

use Core\App;

require_once '../vendor/autoload.php';

$app = new App();
require_once '../myRoutes/routes.php';
require_once '../helpers/helpers.php';

$app->run();
