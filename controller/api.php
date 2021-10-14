<?php
class api extends base
{
    function getdata()
    {
        $a = $this->getMsg();
        $b = explode(PHP_EOL, $a->links);
        shuffle($b);
        $a->link = end($b);
        echo json_encode($a);
    }
    function login()
    {
        //  防止全局变量造成安全隐患
        $admin = false;
        //  启动会话，这步必不可少
        session_start();
        //  判断是否登陆
        if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
            echo  $this->page("reLogin");
        } else {
            echo $this->page("login");
        }
    }
    function logincheck()
    {
        header('Content-Type:application/json');
        $user = 'cjie';
        $pwd = '9b77460932604fddae971ef9bb130bf8';
        $post = json_decode($_POST['json']);
        $rUser = $post->user;
        $rPwd = md5($post->pwd . "cjie");
        $erro = 1;
        $msg = '密码错误';
        if ($user === $rUser && $pwd === $rPwd) {
            $erro = 0;
            $msg = '登录成功，点击确认进入后台';
            session_set_cookie_params(24 * 3600);
            session_start();
            $_SESSION['admin'] = true;
        }
        $a = [
            'erro' => $erro,
            'msg' => $msg,
        ];
        echo json_encode($a);
    }
}
