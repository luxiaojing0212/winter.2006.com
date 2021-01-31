<?php
include "pdo.php";
$pdo = getPdo();
// //接收变量
$account = $_GET['account'];


// $sql2 = "select * from user where account = '{$account}'";
$sql2 = "select * from user where account= '{$account}' or mobile = '{$account}' or email = '{$account}'";
$res2 = $pdo->query($sql2);
$data2 = $res2->fetch(PDO::FETCH_ASSOC);
// print_r($data2);
if($data2){
    $response = [
        'erron'=>4001,
        'msg'=>'内容经存在'
    ];
}else{
    $response = [
        'erron'=>0,
        'msg'=>'ok'
    ];
}
echo (json_encode($response));

?>