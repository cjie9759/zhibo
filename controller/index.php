<?php

class index extends base
{
    function __construct()
    {
        $this->islogin();
    }
    function index()
    {
        echo $this->page("index");
    }
    function query()
    {
        header('Content-Type:application/json');
        $data = $this->getMsg();
        $msg = "right";
        $erro = 0;
        $a = [
            'erro' => $erro,
            'msg' => $msg,
            'data' => $data
        ];
        echo json_encode($a);
    }
    function commit()
    {
        header('Content-Type:application/json');
        $data = json_decode($_POST['json']);
        // $data = json_decode($this->getMsg());
        $this->setMsg($data);
        $msg = "提交成功";
        $erro = 0;
        $a = [
            'erro' => $erro,
            'msg' => $msg,
            'data' => $data
        ];
        echo json_encode($a);
    }
    function upload()
    {
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);        // 获取文件后缀名

        $data['msg'] = '上传失败';
        $data['erro'] = 1;
        header('Content-Type:application/json');
        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "image/x-png")
                || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 204800 * 25)    // 小于 200 kb
            && in_array($extension, $allowedExts)
        ) {
            if ($_FILES["file"]["error"] > 0) {
                $data['msg'] = "错误：: " . $_FILES["file"]["error"] . "<br>";
            } else {
                // echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
                // echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
                // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                // echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];
                if (!file_exists('./upload/')) {
                    mkdir('./upload/', 0777, true);
                }
                $save_path = "./upload/" . date("Ymd") . md5(md5($_FILES["file"]["name"]) . random_bytes(10)) . '.' . $extension;
                $a = move_uploaded_file($_FILES["file"]["tmp_name"], $save_path);
                if ($a) {
                    $data['erro'] = 0;
                    $data['msg'] = '上传成功';
                    $data['url'] = $save_path;
                }
                // echo "文件存储在: " .$save_path;
            }
        } else {
            $data['msg'] = "非法的文件格式";
        }
        echo json_encode($data);
    }
}
