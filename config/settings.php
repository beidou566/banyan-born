<?php

// Error reporting for development 开发错误报告
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Error reporting for production
//error_reporting(0);
//ini_set('display_errors', '0');

// Timezone 默认中国时区
date_default_timezone_set('PRC');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);

// Error Handling Middleware settings  Error中间件设置
$settings['error'] = [
    // Should be set to false in production 正式发布时,设置为false
    'display_error_details' => true,

    // Parameter is passed to the default ErrorHandler 参数传递给默认的ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting. 通过启用"displayErrorDetails"查看渲染输出。
    // For the console and unit tests we also disable it 控制台和单元测试时,设置为false
    'log_errors' => true,

    // Display error details in error log  显示详细错误信息
    'log_error_details' => true,
];

// Database settings 数据库设置
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
