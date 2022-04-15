##   常用命令
//更新框架
composer update
//新配置后，加载框架
composer dump-autoload

##   框架来源 Slim 4 Tutorial
    https://github.com/odan/slim4-tutorial
    https://odan.github.io/2019/11/05/slim4-tutorial.html

##   目录结构
├── app/
│   └── common          基础的
│   └── action            入口
│   └── route           URL路由(该目录下的文件会自动加载)
│   └── index.php       入口
├── conf/               配置文件
├── public/             
│   └── .htaccess       Apache定向规则
│   └── index.php       入口
├── tmp/                临时文件(cache and log)
├── vendor/             composer 目录
├── .htaccess           重定向到 public/ directory
└── .gitignore          Git忽略规则


##   函数和类、属性命名
  类的命名采用驼峰法（首字母大写），例如 User、UserType；
  函数的命名使用小写字母和下划线（小写字母开头）的方式，例如 get_client_ip；
  方法的命名使用驼峰法（首字母小写），例如 getUserName；
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

2.[问题描述]：
      git 和 小乌龟TortoiseGit提交代码冲突
  [解决办法]：
    小乌龟的设置中网络,如下修改
    D:\Program Files\TortoiseGit\bin\TortoiseGitPlink.exe => C:\Program Files\Git\usr\bin\ssh.exe
  [解决思路]
    https://www.pianshen.com/article/73391156969/


