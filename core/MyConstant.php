<?php

$app_base = str_replace('\\', '/', realpath(dirname(__FILE__) . '/../')) . "/"; //当前文件所在的目录
//echo $app_base;
define("ROOT_PATH", $app_base); // D:/PHPCUSTOM/wwwroot/[app name]/
define("APP_NAME", explode("/", ROOT_PATH)[count(explode("/", ROOT_PATH))-2]); //"php-banyan"
define("STYLE_PATH", $app_base."public/style/"); //D:/PHPCUSTOM/wwwroot/php-banyan/public/style/
define("VIEW_PATH",$app_base."app/view/"); //D:/PHPCUSTOM/wwwroot/php-banyan/app/view/

$url_root_nohttp = substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1); //    /[app name]/app/public/
//echo $url_root_nohttp;
define("URL_ROOT_NOHTTP", $url_root_nohttp);

$url_style = $url_root_nohttp . 'app/style'; //    /[app name]/app/public/app/style
define("URL_STYLE", $url_style);

