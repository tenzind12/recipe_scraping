<?php
header("Content-type:application/json");

function load_class($class) {
    require_once $class . '.php';
}

spl_autoload_register('load_class');


$http_verb = $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    foreach($_GET as $key => $value) {
        $params[$key] = $value;
    }
}

if(isset($_REQUEST['request'])) {
    $request  = explode('/', $_REQUEST['request']);
    $resource = $request[0];
    
    if (isset($request[1])) {
        $resource_id = $request[1];
    } else {
        $resource_id = '';
    }
    
    if ($resource == 'products') {
        $request = new Products;
    }
    
    if ($http_verb == 'GET') {
    
        if (!empty($resource_id)) {
            $response = $request->read($resource_id);
        } else {
            $response = $request->read($resource_id, $params);
        }
    
        echo $response;
    }
}