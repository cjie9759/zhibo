<?php
class base
{
    function getMsg()
    {
        $a = json_decode(file_get_contents('../config'));
        return $a;
    }
    function setMsg($data)
    {
        $a = json_encode($data);
        file_put_contents('./config', $a);
    }
    function islogin()
    {
        //  防止全局变量造成安全隐患
        $admin = false;
        //  启动会话，这步必不可少
        session_start();
        //  判断是否登陆
        if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
            $_SESSION["admin"] = false;
            session_destroy();
            echo $this->page("noLogin");
            exit();
        }
    }
    function page($f)
    {
        return file_get_contents("../page/" . $f . ".html");
    }
}













// function connectDemo($value = '')
// {
//     // include '../private/dbconfig.php';
//     $dbms = 'mysql';     //数据库类型
//     $host = 'localhost'; //数据库主机名
//     $port = '3306';    //端口
//     $dbName = 'zhibo';    //使用的数据库
//     $user = 'root';      //数据库连接用户名
//     $pass = '';          //对应的密码
//     $dsn = "$dbms:host=$host;port=$port;dbname=$dbName";

//     try {
//         $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
//     } catch (PDOException $e) {
//         die("Error!: " . $e->getMessage() . "<br/>");
//     }
//     //默认这个不是长连接，如果需要数据库长连接，需要最后加一个参数：array(PDO::ATTR_PERSISTENT => true) 变成这样：
//     // $dbh = new PDO($dsn, $user, $pass);
//     return $dbh;
// }
// function getMesDemo($value = '')
// 
//     $a['erro'] = 1;
//     $conn = $this->connect();
//     try {
//         $sql = "SELECT * FROM `index` WHERE `id`=1";
//         $a = $conn->query($sql)->fetch();
//         $a['erro'] = 0;
//         return $a;
//     } catch (PDOException $e) {
//         $a['erro'] = 1;
//         return $a;
//     }
//     $conn = null;
// }