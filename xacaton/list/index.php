<?php
//require 'vendor/autoload.php';
//$nameVideo = 'video.mkv';
//$redis = new Redis();
//$redis->connect('127.0.0.1', 6379);
//
//$ffmpeg = FFMpeg\FFMpeg::create();
//$video = $ffmpeg->open($nameVideo);
//$video
//    ->filters()
//    ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
//    ->synchronize();
//
//for ($i = 1; $i<=30; $i++){
//   $video
//    ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($i))
//    ->save(__DIR__.'/frame/'.$i.'.'.$nameVideo.'.frame.jpg'); 
//   $redis->rPush($nameVideo, $i.'.'.$nameVideo.'.frame.jpg');
//}
//
//
//$p = $redis->lrange($nameVideo,0,-1);
//var_dump($p);
$file_get = $_SERVER["DOCUMENT_ROOT"] . "/modules/log/get.log";
$file_post = $_SERVER["DOCUMENT_ROOT"] . "/modules/log/post.log";
if (!empty($_GET)) {
    $fw = fopen($file_get, "a");
    fwrite($fw, "GET " . var_export($_GET, true));
    fclose($fw);
       error_log($_GET, 0);
       var_dump($_GET);
}

if (!empty($_POST)) {
    $fw = fopen($file_post, "a");
    fwrite($fw, "POST " . var_export($_POST, true));
    fclose($fw);
       error_log($_POST, 0);
       var_dump($_POST);
}

?>