<?php
require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
//$nameVideo = 'video.mkv';
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$file_get = $_SERVER["DOCUMENT_ROOT"] . "/modules/log/post.log";
$file = $_SERVER["DOCUMENT_ROOT"] . "/modules/log/";
 if($json = file_get_contents("php://input")) {
       $json = json_decode($json, true);
       $userId = $json[userId];
        $req = $redis->lrange($userId, 0, -1);
        $arr = [];
        foreach ($req as $key => $request){
           $exp = explode('.',$request);
           $arr += [$exp[0]=>$exp[1]];
        }
       $arr = json_encode($arr);
       echo $arr;
  }