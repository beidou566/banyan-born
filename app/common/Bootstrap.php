<?php

use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../../vendor/autoload.php';

//添加全局 通用函数类
require_once __DIR__ . '/Constant.php';
require_once __DIR__ . '/Instance.php';


$containerBuilder = new ContainerBuilder();

// Add DI container definitions 添加 DI container 依赖注入
$containerBuilder->addDefinitions(__DIR__ . '/Container.php');

// Create DI container instance
$container = $containerBuilder->build();

// Create Slim App instance
$app = $container->get(App::class);


// Register middleware 在容器中注册 中间件
(require __DIR__ . '/Middleware.php')($app);


//自动注册 路由类 文件夹
$arr_file_route=Instance::get_instance()->scan_all(__DIR__."/../route/");
foreach($arr_file_route as $file){
  (require $file)($app);
}

return $app;
