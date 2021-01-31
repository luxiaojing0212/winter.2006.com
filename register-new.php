<?php
include "pdo.php";
$pdo = getPdo();
// //接收变量
$account = $_POST['account'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$pwdd = $_POST['pwdd'];

//验证密码是否一致
if($pwd != $pwdd){
    $response = [
        'errnu'=>4001,
        'meg'=>'密码有误'
    ];
    die(json_encode($response));
}
//验证密码不能小于6位
if(strlen($pwd)<6){
    $response = [
        'errnu'=>4002,
        'meg'=>'密码长度不够'
    ];
    die(json_encode($response));
}
//用户密码使用 password_hash生成

//用户名已存在
$sql2 = "select * from user where account = '$account'";
$res2 = $pdo->query($sql2);
$data2 = $res2->fetch(PDO::FETCH_ASSOC);
if($data2){
    $response = [
        'errnu'=>4003,
        'meg'=>'账号已经存在'
    ];
    die(json_encode($response));
}
//手机号已存在
$sql3 = "select * from user where mobile = '$mobile'";
$res3 = $pdo->query($sql3);
$data3 = $res3->fetch(PDO::FETCH_ASSOC);
if($data3){
    $response = [
        'errnu'=>4004,
        'meg'=>'手机号已经存在'
    ];
    die(json_encode($response));
}
//Email已存在
$sql4 = "select * from user where email = '$email'";
$res4 = $pdo->query($sql4);
$data4 = $res4->fetch(PDO::FETCH_ASSOC);
if($data4){
    $response = [
        'errnu'=>4005,
        'meg'=>'邮箱已经存在'
    ];
    die(json_encode($response));
}
//使用mysqli链接数据库
//生成用户密码
$password = password_hash($pwd,PASSWORD_BCRYPT);
$sql1 = "insert into user(account,mobile,email,pwd) values('$account','$mobile','$email','$password')";
// echo $sql1;die;
$res = $pdo->query($sql1);
$res = [
    'errnu'=> 0,
    'meg'=>'注册成功'
];
echo json_encode($res)
?>