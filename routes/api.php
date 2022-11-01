<?php
$router = new \Bramus\Router\Router();

$router->setNamespace('\App'); //Todos los namespaces empiezna con App
 
//Rutas
$router->get('/', function(){
    echo "<h2>Bienvenido a tu API REST de ropa merch</h2>";
});


$router->get('/clothes', 'controllers\ClothesController@all');
$router->get('/clothes/(\d+)', 'controllers\ClothesController@getById');

$router->put('/clothes/(\d+)', 'controllers\ClothesController@update');
$router->delete('/clothes/(\d+)', 'controllers\ClothesController@delete');
$router->post('/clothes', 'controllers\ClothesController@insert');



$router->set404(function(){
    echo "La ruta establecida no existe";
});

$router->run();