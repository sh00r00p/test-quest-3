<?php

class defaultController 
{
	
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
	}
	
	function index()
	{
		$model = new defaultModel();
		$students = $model->getList();
		$rates = $model->getRates();

		$this->view->generate($students, 'list', $rates);
	}

	function add()
	{
		$model = new defaultModel();
		$students = $model->getList();
		
		$this->view->generate($students, 'add');
	}

	function addRow()
	{
		$formData = $_POST;
		$model = new defaultModel();
		$response = $model->addStudent($formData);
		
		echo $response;
	}

	function edit($arr)
	{
		$id = array_pop($arr);
		$model = new defaultModel();
		
		if((int)$id) {
			$row = $model->getRow($id);
			$groups = $model->getGroups();
		}

		$this->view->generate($row, 'edit', $groups);
	}

	function top()
	{
		$model = new defaultModel();
		$top = $model->getTop(10);

		$this->view->generate($top, 'top');
	}

	function update()
	{
		$formData = $_POST;
		$model = new defaultModel();
	
		$response = $model->updateRow($formData);

		header('Location: /');
	}
}