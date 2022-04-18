<?php
use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;
use Slim\ResponseEmitter as SlimResponseEmitter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Banyan\Core\HttpErrorHandler;
use Banyan\Core\ShutdownHandler;


require __DIR__ . '/MyConstant.php';//全部变量
require __DIR__ . '/MyInstance.php';//全局函数
require __DIR__ . '/DotEnv.php';//加载EVA
require __DIR__ . '/Dependencies.php';//加载DI 中间件
//自动注册 Core 文件夹
$arr_file_route=MyInstance::get_instance()->scan_all(__DIR__."/auto/");
foreach($arr_file_route as $file){
  require $file;
}

// 创建 PHP-DI container
$containerBuilder = new ContainerBuilder();
// Add DI
$dependencies = new Dependencies();
($dependencies)($containerBuilder);
// 初始化  $app
$container = $containerBuilder->build();
AppFactory::setContainer($container);
$app = AppFactory::create();



// // 创建 the request object from the server's globals
// $serverRequestCreator = ServerRequestCreatorFactory::create();
// $request = $serverRequestCreator->createServerRequestFromGlobals();
// // 创建 error handler ...
// $callableResolver = $app->getCallableResolver();
// $responseFactory = $app->getResponseFactory();
// $errorHandler= new HttpErrorHandler($callableResolver, $responseFactory);
// // 创建 shutdown handler ...
// $displayErrorDetails = $container->get('settings')['debug'];
// $shutdownHandler= new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
// register_shutdown_function($shutdownHandler);


//(require __DIR__ . '/Cors.php')($app);
(require __DIR__ . '/Routes.php');


$app->run();
