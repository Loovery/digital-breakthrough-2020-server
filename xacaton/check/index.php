<?php 
include 'db.php';
$db = new db;
$list = $db->mrow('SELECT `name` FROM `NewPhoto` WHERE `old` = 0');
foreach($list as $lists){
    $phot.="'";
    $phot.=$lists[name];
    $phot.="'";
    $phot.=',';
}
 $phot = substr($phot, 0, -1);
 
$timer = $db->mrow("SELECT `date_time` FROM `NewPhoto` ORDER BY `date_time` DESC LIMIT 1");
$timer = $timer[0]["date_time"];
$currentDate = strtotime($timer);
$futureDate = $currentDate+(60*30+1);
$formatDate = date("Y-m-d H:i:s", $futureDate);
?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>НарушайКа</title>
    <style>
        *{
    font-family: Areal;
}
        .wrapper{
            margin-top: -2vh;
    position: relative;
    justify-content: center;
    display: flex;
    max-height: 95vh;
        }
        #img{   
          position: absolute;
    display: flex;
    justify-content: center;
    bottom: 50px;
    z-index: 2;
    width: 100%;
        }
        #button_group{
    position: absolute;
    display: flex;
    justify-content: center;
    bottom: 50px;
    z-index: 2;
    width: 100%;
        }
        .modal {
  display: block; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 190px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 25%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.8s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #007bff;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
    </style>
  </head>
  <body style="overflow:hidden">
     
      <div id="myModal" class="modal" style="z-index:3 ">

  <div class="modal-content">
    <div class="modal-header">
      <h2>Необходима верификация</h2>
    </div>
    <div class="modal-body" style="
    padding-bottom:21px">
        <p>Введите код  ниже</p>
<div class="input-group mb-3">
  <input id="myInput" type="text" autofocus class="form-control" placeholder="Ваш код" aria-label="ваш код" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button id='myBtn' onClick="check();" class="btn btn-outline-secondary" type="button">Вход</button>
    
  </div>
</div>
    </div>
  </div>

</div>
      <nav class="navbar navbar-dark bg-primary" style="z-index:2">
<span class="navbar-brand mb-0 h1">НарушайКа</span>
<span id="inf" class="navbar-text" style="color: white">
      
    </span>
<span id="miss" class="navbar-text" style="color: white">
      
    </span>
<span id="timer" class="navbar-text" style="color: white">
    </span>
</nav>

    <div class='wrapper'>

        <img id="image" style="width: 100%" ondrag="return false" ondragdrop="return false" ondragstart="return false" src='img/1.jpg'>
        <div id='button_group' style="display:none">
    <button id='button' onClick="imgsrc(0);" style="font-size: 4vh" type="button" class="btn btn-success btn-lg ">Нет</button>
    <button id='button' onClick="imgsrc(1);" style="margin-left: 10%; font-size: 4vh"id='button' type="button" class="btn btn-danger btn-lg">Есть!</button> 
    </div>
    </div>  
   
 
      <script language="javascript">
    var i = 0;
    var a = 0;
    var miss = 0;
    var image=document.getElementById("image");
    var imgs= ['1.jpg',<?php echo $phot;?>,'end.jpg']; 
    var kadr = [<?php echo $phot ?>];
    var dis = 0;
    function imgsrc(dis) {
        if(dis === 1){
            miss++;
        }
    i++;i%=imgs.length;
    image.src = "img/"+imgs[i];
    var inf="Выполнено "+a+" из "+kadr.length;
    document.getElementById("inf").innerHTML = inf;
    var name =  imgs[i-1];
    
    
    var missing="Обнаружено "+miss+" нарушений";
    document.getElementById("miss").innerHTML = missing;
    post(name,dis);
    };

    var modal = document.getElementById("myModal");

    function check(){
    var getNum = document.getElementById('myInput').value;
    console.log(getNum);
    if(getNum === 'd87j587'){
       modal.style.display = "none";
       button_group.style.display = "flex";
    }else(alert('Неправильный код!'));
        };
       
    

var input = document.getElementById("myInput");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
      check();
  }
});
    
    var countDownDate = new Date("<?php echo $formatDate?>").getTime();
    var x = setInterval(function() {
    var now = new Date().getTime();  
    var distance = countDownDate - now;  
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);   
    document.getElementById("timer").innerHTML = 'Осталось '+ minutes + " Мин " + seconds + " Сек";
    var clock = 'Осталось '+ minutes + " Мин " + seconds + " Сек";
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "просрочено:"+(kadr.length-a);
    }
}, 1000);

function post(name,dis){
    console.log(dis)
    a++;
    $(document).ready(function(){
    $.post("engine.php",
    {
        
      name: name,
      dis: dis
    },
   //function(data,status){
   //  console.log("Data: " + data + "\nStatus: " + status + "\ninfo: " + imgs[i] + "\nесть нарушение: " + dis);
   });
});
}
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
