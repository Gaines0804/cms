<?php
/** .-------------------------------------------------------------------
 * | 函数库
 * '-------------------------------------------------------------------*/
function default_pic($img){
    //将获得的图片路径接收到，如果有上传图片那么就显示上传的图片，如果没有显示默认的图片
    return $img ?: 'resource/images/nopic.jpg';
}

/**
 * 定义常量，用来判断后台头部选中效果
 */
//?s=wechat/config/setting
if(isset($_GET['s'])){
    //将get参数转换为数组，我们需要分别获得其中的一部分，来定义常量
    $s = explode('/',$_GET['s']);
    //p($s);
//    Array
//    (
//        [0] => admin
//        [1] => category
//        [2] => lists
//    )
    //定义常量
    //常量可以在任何地方使用
    define('APP',strtolower($s[0]));
    define('CONTROLLER',strtolower($s[1]));
    define('ACTION',strtolower($s[2]));
}


//定义一个函数url
//?m=student&a=controller/grade/store
//定义一个函数，当用户传参数如url('student.grade.lists'),我们对det参数进行处理
function url($path,$arg=[]){
    //把数组['bid'=>1] 转换成 bid=1
    $args = http_build_query($arg);
    //p($args);
    $path = explode('.',$path);
    //p($path);
    //这里使用__WEB__来组合完整路径，如果不用的话就会出现index.php?s=?m=base/wechat/lists错误，无法访问指定的方法
    return __WEB__."?m={$path[0]}&a=controller/{$path[1]}/{$path[2]}&{$args}";
}