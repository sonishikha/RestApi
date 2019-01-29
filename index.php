<?php
ini_set("error_reporting", E_ALL);
require_once('config/constants.php'); //Call constants

require_once(CONFIG.'/authentication.php');
/*$authenticate = new Authenticate();
$authenticate->authentication();*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try{
	$dirPath = getcwd();
	require realpath($dirPath . DS . 'app.php'); 
	
	$entity = $action = $entityId = $search = '';
	
	// Check if entity is set
	if(!isset($_GET['entity']) || empty($_GET['entity'])){
		throw new Exception('No entity found.', ERROR_CODE['BAD_REQUEST']);
	}
	$entity = ucfirst(trim($_GET['entity']));
	//Check valid entity name
	if(!preg_match('#[A-Za-z]#', $entity)){
		throw new Exception('Please enter valid entity name.', ERROR_CODE['BAD_REQUEST']);
	}

	//Check if search key available and set entity id or search varialble according to the type
	if(isset($_GET['searchKey']) && !empty($_GET['searchKey'])) {
		if(preg_match('#\d#', $_GET['searchKey'])){
			$entityId = trim($_GET['searchKey']);
		}
		if(preg_match('#[A-Za-z]#', $_GET['searchKey'])){
			$search = trim($_GET['searchKey']);
		}
	}

	$filePath = APP . 'Controllers' . DS . $entity . "Controller.php";
	//checking if file exists
	if (!file_exists($filePath)) {
		throw new Exception('Entity not found.', ERROR_CODE['BAD_REQUEST']);
	}
	$controllerClassName = $entity . 'Controller';
	require_once($filePath);
	$obj = new $controllerClassName(); //Entity controller

	switch(filter_input(INPUT_SERVER, 'REQUEST_METHOD')){ 
		case 'GET':{
			$products_data = array();
			if(!empty($entityId)){ // if id available get data by id
				$products_data = $obj->getById($entityId);
			}elseif(!empty($search)){
				$products_data[] = "Search by product";
			}else{ //else get all the data
				$products_data = $obj->getAll();
			}
			if(is_array($products_data)){ //Read Response 
				print_r(App::showResponse(true, ERROR_CODE['OK'], $products_data ));
			}else{
				throw new Exception("Cannot get data.", ERROR_CODE['INTERNAL_SERVER_ERROR']);	
			}
			break;
		}
		case 'POST':{
			$data = array();
			//Check if post data available
			if(!isset($_POST) || empty($_POST)){
				throw new Exception('Post data not available.', ERROR_CODE['BAD_REQUEST']);
			}
			//Get entity table columns to insert data properly to that columns  
			$columns = $obj->getTableColumns($entity); 
			if($columns){
				$invalidColumns = '';
				$invalidColumnCount = 0;
				foreach ($_POST as $key => $value) {
					$key = trim($key);
					//Check if valid column name is given as a key in post data
					if(!in_array($key, array_column($columns, 'COLUMN_NAME'))){ 
						$invalidColumns .= $key.",";
						$invalidColumnCount++;
					}else{
						if(!is_array($value)){
							if(empty(trim($value))){
								$index = array_search($key, array_column($columns, 'COLUMN_NAME'));
								if($columns[$index]['IS_NULLABLE'] == 'NO'){ //Check if column can hold null value
									throw new Exception($key.' column cannot be null.', ERROR_CODE['BAD_REQUEST']);
								}
							}
							$data[trim($key)] = App::filterData($value); //Filter data
						}
					}
				}
				if($invalidColumnCount>0){
					throw new Exception('Invalid columns:'.trim($invalidColumns, ',').'.', ERROR_CODE['BAD_REQUEST']);
				}
			}
			//Create Response
			if($obj->createRecord($data)){
				print_r(App::showResponse(true, ERROR_CODE['RESOURCE_CREATED'], 'Record inserted.'));
			}else{
				throw new Exception('Record not created.', ERROR_CODE['INTERNAL_SERVER_ERROR']);	
			}
			break;
		}
		case 'PUT':{
			header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
			$data = array();
			parse_str(file_get_contents("php://input"), $putData);
			if(!isset($putData) || empty($putData)){ //Check if put data available
				throw new Exception('Put data not available.', ERROR_CODE['BAD_REQUEST']);
			}
			if(!empty($entityId)){ //check if valid entity id
				throw new Exception('Id not available to update record.',ERROR_CODE['BAD_REQUEST']);
			}
			$columns = $obj->getTableColumns($entity);//Get entity table columns to insert data properly to that columns 
			if($columns){
				$invalidColumns = '';
				$invalidColumnCount = 0;
				foreach ($putData as $key => $value) {
					$key = trim($key);
					//Check if valid column name is given as a key in post data
					if(!in_array($key, array_column($columns, 'COLUMN_NAME'))){
						$invalidColumns .= $key.",";
						$invalidColumnCount++;
					}else{
						if(!is_array($value)){
							if(empty(trim($value))){
								$index = array_search($key, array_column($columns, 'COLUMN_NAME'));
								if($columns[$index]['IS_NULLABLE'] == 'NO'){ //Check if column can hold null value
									throw new Exception($key.' column cannot be null.', ERROR_CODE['BAD_REQUEST']);
								}
							}
							$data[trim($key)] = App::filterData($value);//Filter data
						}
					}
				}
				if($invalidColumnCount>0){
					throw new Exception('Invalid columns:'.trim($invalidColumns, ',').'.', ERROR_CODE['BAD_REQUEST']);
				}
			}
			//Update response
			if($obj->updateById($entityId, $data)){
				print_r(App::showResponse(true, ERROR_CODE['RESOURCE_CREATED'], 'Record updated.'));
			}else{
				throw new Exception('Record not updated.', ERROR_CODE['INTERNAL_SERVER_ERROR']);	
			}
			break;
		}	
		case 'DELETE':{
			$data = "";
			if(empty($entityId)){ //Check if entity id is set
				throw new Exception('Id not available to delete record.', ERROR_CODE['BAD_REQUEST']);
			}
			//Delete response
			if($obj->deleteById($entityId)){
				print_r(App::showResponse(true, ERROR_CODE['OK'], 'Record delete.'));
			}else{
				throw new Exception('Record not delete.', ERROR_CODE['INTERNAL_SERVER_ERROR']);	
			}
			break;
		}
		default:{
			//any invalid method
			throw new Exception('The method specified in the request is not allowed.', ERROR_CODE['INVALID_METHOD']); 
		}
	}	
} catch (Exception $e){
	print_r(App::showResponse(false, $e->getCode(), $e->getMessage()));
}
?>