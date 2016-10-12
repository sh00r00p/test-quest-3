<?php

class Routing
{

	static function execute() 
	{
		$component = 'router';
		$controllerName = 'default';	
		$actionName = 'index';
		$piecesOfUrl = explode('/', $_SERVER['REQUEST_URI']);
		
		if (!empty($piecesOfUrl[1])) $controllerName = $piecesOfUrl[1];
		if (!empty($piecesOfUrl[2])) $actionName = $piecesOfUrl[2];

		$modelName = strtolower($controllerName) . 'Model';
		$controllerName = strtolower($controllerName) . 'Controller';

		$reporting = new Error;
		
		$fileWithModel = $modelName . '.php';
		$fileWithModelPath	= "app/models/" . $fileWithModel;
		if (file_exists($fileWithModelPath)) {
			include_once $fileWithModelPath;
		} else {
			$message = 'Error! Unable to connect the model file <b>' . $fileWithModelPath;
			$reporting->setError($message, $component);
		}

		$fileWithController = $controllerName . '.php';
		$fileWithControllerPath = "app/controllers/" . $fileWithController;
		if (file_exists($fileWithControllerPath)) {
			include_once $fileWithControllerPath;
		} else {
			$message = 'Error! Unable to connect the controller file <b>' . $fileWithControllerPath;
			$reporting->setError($message, $component);
		}

		$controller = new $controllerName;
		$action = $actionName;
		if (method_exists($controller, $action)) {
			call_user_func(array($controller, $action), $piecesOfUrl);
		} else {
			$message = '<b>Error!</b> Unable to connect the controller function: <b>' . $action;
			$reporting->setError($message, $component);
		}
	}	
}