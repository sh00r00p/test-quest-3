<?php

class Routing
{

	static function execute() 
	{
		$controllerName = 'default';	
		$actionName = 'index';
		$piecesOfUrl = explode('/', $_SERVER['REQUEST_URI']);
		
		if (!empty($piecesOfUrl[1])) 
		{
			$controllerName = $piecesOfUrl[1];
		}
		if (!empty($piecesOfUrl[2]))
		{
			$actionName = $piecesOfUrl[2];
		}
		$modelName = strtolower($controllerName) . 'Model';
		$controllerName = strtolower($controllerName) . 'Controller';

		$reporting = new Error;
		$e_reporting = $reporting->getReport();

		$fileWithModel = $modelName . '.php';
		$fileWithModelPath	= "app/models/" . $fileWithModel;
		if (file_exists($fileWithModelPath))
		{
			include_once $fileWithModelPath;
		}
		else
		{
			if($e_reporting === 'none' || $e_reporting === 'default'){
				$message = 'Error! Unable to connect the model file <b>' . $fileWithModelPath;
				$reporting->setError($message);
				header("HTTP/1.0 404 Not Found");
				include("error.html");
				die(); 
			} elseif($e_reporting === 'develop'){
				die('<b>Error!</b> Unable to connect the model file <b>' . $fileWithModelPath);
			}
		}
		$fileWithController = $controllerName . '.php';
		$fileWithControllerPath = "app/controllers/" . $fileWithController;
		if (file_exists($fileWithControllerPath))
		{
			include_once $fileWithControllerPath;
		}
		else
		{
			if($e_reporting === 'none' || $e_reporting === 'default'){
				$message = 'Error! Unable to connect the controller file <b>' . $fileWithControllerPath;
				$reporting->setError($message);
				header("HTTP/1.0 404 Not Found");
				include("error.html");
				die(); 
			} elseif($e_reporting === 'develop'){
				die('<b>Error!</b> Unable to connect the controller file <b>' . $fileWithControllerPath);
			}
		}
		$controller = new $controllerName;
		$action = $actionName;
		if (method_exists($controller, $action))
		{
			call_user_func(array($controller, $action), $piecesOfUrl);
		}
		else
		{
			if($e_reporting === 'none' || $e_reporting === 'default'){
				$message = '<b>Error!</b> Unable to connect the controller function: <b>' . $action;
				$reporting->setError($message);
				header("HTTP/1.0 404 Not Found");
				include("error.html");
				die();
			} elseif($e_reporting === 'develop'){
				die('<b>Error!</b> Unable to connect the controller function: <b>' . $fileWithControllerPath);
			}
		}
	}	
}