##   组合框架
    slim4 + twig +medoo

##   目录结构
    .
├── core/                 配置文件
│   └── App.php           index.php call this
│   └── Container.php     PHP-DI创建的组件 monolog twig medoo在此引入
│   └── DotEnv.php        引入 .evn
│   └── Middlewares.php   中间件 ErrorHandler.php 异常错误处理在此引入
│   └── Route.phpp        用户路由类
│   └── RouteCors.php     跨域路由
│   └── RouteNotFound.php 未发现路由
├── public/             
│   └── .htaccess         Apache定向规则
│   └── index.php         入口
├── src/                
│   └── Action/           控制层
│   └── Mapper/           数据库处理
│   └── View/             Twig 模板
├── var/                  临时文件(cache and log)
├── vendor/               composer 目录
├── .htaccess             重定向到 public/ directory
└── .gitignore            Git忽略规则
└── composer.json         
└── data.sql              demo 数据sql 
└── README.md             说明 

##   函数和类、属性命名
  文件夹命名使用小写字母，例如 core
  类的命名采用驼峰法（首字母大写），例如 User、UserType；
  方法的命名使用驼峰法（首字母小写），例如 getUserName；
  函数的命名使用小写字母和下划线（小写字母开头）的方式，例如 get_client_ip；
  属性的命名使用驼峰法（首字母小写），例如 tableName、instance；
  特例：以双下划线__打头的函数或方法作为魔术方法，例如 __call 和 __autoload；

##   常量和配置
  常量以大写字母和下划线命名，例如 APP_PATH；
  配置参数以小写字母和下划线命名，例如 url_route_on 和url_convert；
  环境变量定义使用大写字母和下划线命名，例如APP_DEBUG；

##   数据表和字段
  数据表和字段采用小写加下划线方式命名，并注意字段名不要以下划线开头，例如 think_user 表和 user_name字段，不建议使用驼峰和中文作为数据表及字段命名。

##   搭建遇到的问题
1.[问题描述]：
    Fatal error: Uncaught Error: Undefined constant PDO::MYSQL_ATTR_INIT_COMMAND in ………… 
  [解决办法]：
    php.ini文件里打开关于pdo的扩展,
    ;extension=pdo_mysql => extension=pdo_mysql
  [解决思路]
    https://blog.csdn.net/weixin_36129381/article/details/113472417

##   常用命令
//更新框架
composer update
//新配置后，加载框架
composer dump-autoload

