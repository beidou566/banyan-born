<?php



$app->get('/', 'App\Controller\Hello:getStatus')->setName('main');
$app->get('/hello', 'App\Controller\Hello:getStatusAPI')->setName('main_api');
