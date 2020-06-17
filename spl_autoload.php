<?php
#自定义加载类函数
function my_autoload($classname){
    $file = $classname . '.php';
    if(!class_exists($classname)){
        if(file_exists($file)){
            include $file;
            return true;
        }        
    }
}

#将自定义加载函数注册到自动加载机制中
spl_autoload_register('my_autoload');


