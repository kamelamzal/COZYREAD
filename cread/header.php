<?php
if(session_status() == PHP_SESSION_NONE){

  session_start();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php require_once( 'config.php')?>


</body>
</html>





















<?php if(isset($_SESSION['flash'])): ?>
    <?php foreach($_SESSION['flash'] as $type => $message): ?>
        <div class="alert alert-<?= $type;  ?>">
          <?= $message; ?>
        </div>

        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>