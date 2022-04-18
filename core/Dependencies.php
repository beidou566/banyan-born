<?php
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

/*
*   依赖项
*/
class Dependencies {
    public function __invoke(ContainerBuilder $containerBuilder) {
        
        $containerBuilder->addDefinitions([
            //创建 settings
            'settings' => [
                'debug' => true, // Should be set to false in production
                'logger' => [
                    'name' => 'app',
                    'path' => __DIR__ . '/../var/log/app.log',
                    'level' => Logger::DEBUG,
                    ],
                'twig' => [
                    'path_templates' => __DIR__ . '/../src/View',
                    'path_cache' => __DIR__ . '/../var/cache/'
                ],
                'db'=> [//数据库设置
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'port' => '3306',
                    'database' => '@elep',
                    'username' => 'root',
                    'password' => '168168',
                    'charset' => 'utf8',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => ''
                    ]
                ],
                //创建  slim/http-cache
                'httpcache' => function (ContainerInterface $c) {
                   // $app->add(new \Slim\HttpCache\Cache('public', 86400));
                    return new \Slim\HttpCache\CacheProvider();
                },
                //创建 monolog
                'logger' => function (ContainerInterface $c) {
                    $loggerSettings = $c->get('settings')['logger'];
                    $logger = new Logger($loggerSettings['name']);
    
                    $processor = new UidProcessor();
                    $logger->pushProcessor($processor);
    
                    $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
                    $logger->pushHandler($handler);
    
                    return $logger;
                },
                // 创建 twig
                'view' => function (ContainerInterface $c) {
                    $twigSettings   = $c->get('settings')['twig'];
        
                    $loader = new \Twig\Loader\FilesystemLoader(
                        $twigSettings['path_templates']
                    );
                    $options = [ 'cache' => $twigSettings['path_cache']];    
                    $view = new Twig($loader,$options);    
                    return $view;
                },
                // 创建 Medoo
                'db' => function (ContainerInterface $c) {
                    $medooSettings   = $c->get('settings')['db'];  
                    $view = new \Medoo\Medoo([
                        'database_type' => $medooSettings['driver'],
                        'server' => $medooSettings['host'],
                        'port' => $medooSettings['port'],
                        'username' => $medooSettings['username'],
                        'password' => $medooSettings['password'],                        
                        'database_name' => $medooSettings['database'],
                        'charset' => $medooSettings['charset'],
                        'prefix' => $medooSettings['prefix'],
                        'logging' => $c->get('settings')['debug'],
                        'option' => [
                            // Turn off persistent connections 关闭持久连接 
                            PDO::ATTR_PERSISTENT => false,
                            // Enable exceptions 启用异常
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            // Emulate prepared statements 预处理LIMIT等非表字段参数
                            PDO::ATTR_EMULATE_PREPARES => true,
                            // Set default fetch mode to array
                            // 设置 默认模式为数组,PHPPDO的FETCH_NUM、FETCH_BOTH、FETCH_ASSOC的一种
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                            // Set character 设置 字符集 
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
                            ],
                        'command' => [
                            'SET SQL_MODE=ANSI_QUOTES'
                            ],
                    ]);     
                    return $view;
                },
        ]); 
    }
}
