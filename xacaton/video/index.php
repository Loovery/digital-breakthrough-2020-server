<?php
require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
//$nameVideo = 'video.mkv';
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
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
$file = $_SERVER["DOCUMENT_ROOT"] . "/modules/log/";
 if($json = file_get_contents("php://input")) {
      $fw = fopen($file_get, "a");
     fwrite($fw, "POST " . var_export($json, true));
    fclose($fw);
           $json = json_decode($json, true);
           $name = $json[name];
           $base64 = $json[base64];
           $userid = $json[userId];
           $videoid = $json[videoId];
           $type = $json[type];
          $content= base64_decode($base64);
          if($type == 'video/mp4'){
              $videop = $videoid.'.mp4';
               $file = fopen($file.$videop, 'w');    
            fwrite($file, $content);
            fclose($file);
          }
           $videop = $videoid.'.mov';
           $file = fopen($file.$videop, 'w');    
            fwrite($file, $content);
            fclose($file);
 $redis->rPush($userid, $videoid.'.moderation');   }
 

