<?php

defined('_APP') or die('Restricted access');

require_once 'app/error.php';
require_once 'app/router.php';
require_once 'app/models/defaultModel.php';
require_once 'app/view.php';
require_once 'app/controllers/defaultController.php';
require_once 'app/helper.php';

Routing::execute();