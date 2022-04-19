<?php
require __DIR__ . '/DotEnv.php';//加载EVA

$app = require __DIR__ . '/Container.php';//加载插件
(require __DIR__ . '/Middlewares.php')($app);//加载中间件

(require __DIR__ . '/RouteCors.php')($app); //加载跨域路由
(require __DIR__ . '/Route.php');//加载用户路由
(require __DIR__ . '/RouteNotFound.php')($app); //加载NotFound路由


$app->run();
