<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
include 'db.php';
$db = new db();
$func=$_POST['dis'];
echo $func.'</br> нарушение</br>';
$name = $_POST['name'];
echo $name.'</br> точка </br>';
if($name == '1.jpg'){
    die();
}elseif($name == 'end.jpg'){
    die();
}
$id = $db->cell( 'id', 'NewPhoto',"name LIKE '%$name%'");
echo $id;
if($func == 1){
echo 'есть нарушение</br> </br>';
}
echo $id.'</br> айди фотки </br>';
$address = substr($name, 0, -25);
echo $address.'</br>адрес точки </br>';
$name = 'https://bot.smartmetrics.su/snap/img/'.$name;
echo $name;
$time = $db->cell('date_time', 'NewPhoto',"id = $id");
$address = $db->cell('address', 'NewPhoto',"id = $id");
$time = date("H:i:s",strtotime($time));
$time = substr($time, 0, -3);
if($func == 1){
    $info = 'Было обнаружено нарушение по адресу:'.$address.' '.$time;
       //$id_group = '324063240';
   $id_group = '-1001255895433'; 
//   $sandPhoto = curl_init();
//     curl_setopt($sandPhoto, CURLOPT_URL, "https://api.telegram.org/bot1185876862:AAGWXFxaXBIbNq2g6PVPQdX0dDGHQTirv1A/sendPhoto?"
//       . "chat_id=".$id_group."&photo=".$name."&caption=".$info);
//    curl_setopt($sandPhoto, CURLOPT_HEADER, 0);
//    curl_exec($sandPhoto);
  $upload = $db->qry("UPDATE `NewPhoto` SET `alert`='1' WHERE `id` = $id");
    $upload = $db->qry("UPDATE `NewPhoto` SET `old` = '1' WHERE `id` = $id");
   $db->qry("INSERT INTO `logs` (`name`,`param`,`key`) VALUES ('request','upload alert',$upload)");
   
}
if($func == 0){
   $update = $db->qry("UPDATE `NewPhoto` SET `old` = 1 WHERE `id` = $id");
}
