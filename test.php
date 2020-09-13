   <?php
   require 'vendor/autoload.php';
   //$nameVideo = 'video.mkv';
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);
   ////
   ////$ffmpeg = FFMpeg\FFMpeg::create();
   ////$video = $ffmpeg->open($nameVideo);
   ////$video
   ////    ->filters()
   ////    ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
   ////    ->synchronize();
   ////
   ////for ($i = 1; $i<=30; $i++){
   ////   $video
   ////    ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($i))
   ////    ->save(__DIR__.'/frame/'.$i.'.'.$nameVideo.'.frame.jpg'); 
   ////   $redis->rPush($nameVideo, $i.'.'.$nameVideo.'.frame.jpg');
   ////}
   ////
   ////
   ////$p = $redis->lrange($nameVideo,0,-1);
   ////var_dump($p);
   //
   $redis->rPush('pepep', '.moderation');   
   //
   //
