<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
include 'db.php';
date_default_timezone_set('Europe/Moscow');
$date = date("d.m.y"); 
$db = new db();
$today = $db->count('NewPhoto', "date(`date_time`)=CURDATE() AND `old`= '1' ");
$alert = $db->count('NewPhoto', "date(`date_time`)=CURDATE() AND `alert`= '1' ");
 
//$r = ($today / $alert - 1)*100;
//$r = substr($r, 0 , -11);

    $text = "Ежедневный отчет за ".$date.".\n Было проанализировано: ".$today." Кадров.\n Выявлено нарушений : ".$alert;
    //$text = "Ежедневный отчет за ".$date.".\n Было проанализировано: ".$today." Кадров.\n Выявлено нарушений : ".$alert." (".$r."% нарушений)";
    $texturl = urlencode($text);
   // $id_group = '324063240';
    $id_group = '-1001255895433';
     sendMessage("1185876862:AAGWXFxaXBIbNq2g6PVPQdX0dDGHQTirv1A",$id_group,$texturl);
   function sendMessage($token , $id_group , $text){
    $sendMessage = curl_init();
    curl_setopt($sendMessage, CURLOPT_URL, 
    "https://api.telegram.org/bot".$token."/sendMessage?"
    . "chat_id=".$id_group."&text=".$text."");
    curl_setopt($sendMessage, CURLOPT_HEADER, 0);
    curl_exec($sendMessage);
   }