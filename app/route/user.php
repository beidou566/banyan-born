<?php

use Slim\App;

//路由
 return function (App $app) {
    $app->get('/users/{id}', \App\Action\UserReadAction::class);
    $app->post('/users', \App\Action\UserCreateAction::class);
};
