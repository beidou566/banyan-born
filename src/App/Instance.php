<?php

/*共通类* 单例
Instance::get_instance()->
 */
class Instance
{
    //创建静态私有的变量保存该类对象
    private static $_instance;
    //防止直接创建对象
    private function __construct()
    {}
    //防止克隆对象
    private function __clone()
    {trigger_error('禁止克隆', E_USER_ERROR);}


    public static function get_instance()
    {
        //var_dump(isset(self::$_instance)); //打印初始化信息
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
   
     /**
     * @descr   检测链接是否是SSL连接 也就是判断HTTPS
     * @return bool
     */
    public function is_ssl(){
        if (!isset($_SERVER['HTTPS']))
            return FALSE;
        if ($_SERVER['HTTPS'] === 1){  //Apache
            return TRUE;
        } else if ($_SERVER['HTTPS'] === 'on') { //IIS
            return TRUE;
        } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
            return TRUE;
        }
        return FALSE;
    }

     /**
     * @descr  移除数组的指定元素
     */
    function array_remove_byoffset(&$arr, $offset)
    { 
        array_splice($arr, $offset, 1); 
    }

    /**
     * @descr  移除数组的指定元素
     */
    function array_remove_bykey(&$arr, $key)
    { 
        $offset = array_search($key, $arr);
        array_splice($arr, $offset, 1); 
    }

    /**
     * @descr  数组中null替换空
     * @return bool
     */
    function null_to_str($arr)
    {
        if(!is_array($arr))
                return;
        foreach ($arr as $k=>$v){
            if(is_null($v)) {
                $arr[$k] = '';
            }
            if(is_array($v)) {
                $arr[$k] = Instance::get_instance()->null_to_str($v);
            } 
        }
        return $arr;
    }

     /**
     * @descr  遍历一个文件夹下所有文件和子文件夹的函数
     * @return array
     */   
    function scan_all($dir){
        $files = array();
        $iterator = new DirectoryIterator($dir);
        foreach ($iterator as $fileinfo) {
            if(!$fileinfo->isDot())
            {
                if($fileinfo->isDir())
                {
                    Instance::get_instance()->scan_all($dir.DIRECTORY_SEPARATOR.$fileinfo);
                }
                else
                {
                    $files[] = $fileinfo->getRealPath();    
                }            
            }
        }
        return $files;
    }

}


