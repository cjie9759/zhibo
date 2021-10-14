<?php
// 引入对应class文件 建议采用自动加载的方式
// include("../base.php");
// include("../api.php");

// // 自动加载
spl_autoload_register(function ($class_name) {
    require_once '../controller/' . $class_name . '.php';
});

// pathinfo处理
$pathinfo = explode('/', $_SERVER['PATH_INFO']);
$s1 = $pathinfo[1] ?? 'index';
$s2 = $pathinfo[2] ?? 'index';

// // 过滤非法请求 安全
$safeS = [
    // "base" => ["", "demo"],
    "api" => [
        'getdata',
        'login',
        'logincheck'
    ],
    "index" => [
        'index',
        'query',
        'commit',
        'upload'
    ]
];
isset($safeS[$s1]) && in_array($s2, $safeS[$s1]) ||  exit('erro request');

// // 实例化class、分发请求
$demo = new $s1;
echo $demo->$s2();
// exit('right');

/* 
*    index
*    	index
*    	query
*    	upload
*    	commit
*    api
*        \getdata
*        login
*        logincheck 
*    base
*        islogin
*        getMsg
*        setMsg
*/
