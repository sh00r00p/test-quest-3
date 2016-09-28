<?php

defined('_APP') or die('Restricted access');

require_once 'app/router.php';
require_once 'app/models/defaultModel.php';
require_once 'app/view.php';
require_once 'app/controllers/defaultController.php';

Routing::execute();