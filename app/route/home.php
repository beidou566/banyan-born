<?php
use Slim\App;

//路由
 return function (App $app) {    
    $app->get('/', \App\action\HomeAction::class)->setName('home');
};
