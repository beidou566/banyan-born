<?php

//设定中国时区
date_default_timezone_set('PRC');

// Settings
$settings = [];

//是否为调试，正常环境设置为false
$settings['debug'] = true;

if($settings['debug']==true)
{   
    //开发是显示错误报告
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}
else
{
    error_reporting(0);
    ini_set('display_errors', '0');
}


//数据库设置
$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => '@elep',
    'username' => 'root',
    'password' => '168168',
    'charset' => 'utf8',
    'collation' => 'utf8mb4_unicode_ci',
    'flags' => [
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
];

return $settings;
