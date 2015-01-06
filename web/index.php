<?php
 // web/index.php

 // carga del modelo y los controladores
 require_once __DIR__ . '/../app/Config.php';
 require_once __DIR__ . '/../app/Model.php';
 require_once __DIR__ . '/../app/Controller.php';

//***
//Retrieves the values of the variables so it can do the proper routing
//***
//Controller
if(isset($_GET['controller'])) {
	$controller = ucfirst($_GET['controller']);
}

//Action
if(isset($_GET['action'])) {
	$action = $_GET['action'];
}

//Id (in case it is required)
if(isset($_GET['id'])) {
	$id = $_GET['id'];
}


if(method_exists($controller, $action)){
    call_user_func(array (new $controller, $action));
}else {

     header('Status: 404 Not Found');
     echo '<html><body><h1>Error 404: The controller <i>' .
             $controller.
             '->' .
             $action .
             '</i> does not exist</h1></body></html>';
 }
//Only for test
//Show the contents of the variables passed by the URL

//if(isset($controller)) {
//	echo "controller = $controller\n";
//}

//if(isset($action)) {
//echo "action = $action\n";
//}

//if(isset($id)) {
//echo "id = $id\n";
//}

 // enrutamiento
 
/*$map = array(
	 'login' => array('controller' =>'Controller', 'action' =>'login'),
	 'logIn' => array('controller' =>'Controller', 'action' =>'logIn'),
	 'getQuestionaires' => array('controller' =>'Controller', 'action' =>'getQuestionaires'),
	 
 );

 // Parseo de la ruta
 if (isset($_GET['ctl'])) {
     if (isset($map[$_GET['ctl']])) {
         $route = $_GET['ctl'];
     } else {
         header('Status: 404 Not Found');
         echo '<html><body><h1>Error 404: The route does not exist <i>' .
                 $_GET['ctl'] .
                 '</p></body></html>';
         exit;
     }
 } else {
     $route = 'login';
 }

 $controller = $map[$route];
 // Ejecución del controlador asociado a la ruta

 if (method_exists($controller['controller'],$controller['action'])) {
     call_user_func(array(new $controller['controller'], $controller['action']));
 } else {

     header('Status: 404 Not Found');
     echo '<html><body><h1>Error 404: The controller <i>' .
             $controller['controller'] .
             '->' .
             $controller['action'] .
             '</i> does not exist</h1></body></html>';
 }*/