
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="log" border:solidstyle="">
<?php


session_start();
setcookie('remember', NULL, -1);
unset($_SESSION['auth']);

$_SESSION['flash']['success'] = "<h5 claase='msg' style=' display: block;
background: #D9AAB7;
padding-top:7px;
font-size: 0.8rem;

color:#fff;
text-align: center;
width:280px;
height:40px;
border-radius:20px; 
margin-left:500px;
margin-top:30px;'> you are disconnected successufully</h5>";
header('location: login.php');

?>
</div>


</body>
</html>