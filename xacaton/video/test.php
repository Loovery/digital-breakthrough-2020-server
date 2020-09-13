<?php
require '/vendor/autoload.php';
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->rPush($userid, $videoid.'.moderation');   

