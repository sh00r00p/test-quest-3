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
		
		$fileWithModel = strtolower($modelName) . 'php';
		$fileWithModelPath	= "app/models/" . $fileWithModel;
		if (file_exists($fileWithModelPath))
		{
			include $fileWithModelPath;
		}
		$fileWithController = $controllerName . '.php';
		$fileWithControllerPath = "app/controllers/" . $fileWithController;
		if (file_exists($fileWithControllerPath))
		{
			include_once $fileWithControllerPath;
		}
		else
		{
			die('<b>Ошибка!</b> Невозможно подключить файл контроллера <b>' . $fileWithControllerPath);
		}
		$controller = new $controllerName;
		$action = $actionName;
		if (method_exists($controller, $action))
		{
			call_user_func(array($controller, $action), $piecesOfUrl);
		}
		else
		{
			die('<b>Ошибка!</b> Невозможно подключить метод контроллера: <b>' . $action);
		}
	}	
}