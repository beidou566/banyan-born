<?php
require __DIR__ . '/Constant.php';//全部变量
require __DIR__ . '/Instance.php';//全局函数
require __DIR__ . '/Settings.php';//全局设置
require __DIR__ . '/DotEnv.php';//创建容器

require __DIR__ . '/Container.php';//创建容器


$customErrorHandler = require __DIR__ . '/ErrorHandler.php';
(require __DIR__ . '/Middlewares.php')($app, $customErrorHandler);
(require __DIR__ . '/Cors.php')($app);
(require __DIR__ . '/Database.php');
(require __DIR__ . '/Routes.php');
(require __DIR__ . '/NotFound.php')($app);


$app->run();
