<?php
  //declare(strict_types=1);
  include_once('init.php');
  //session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson-19</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php
    if (!empty($_COOKIE['token']) && empty($_SESSION['userId'])) {
      $result = authenticateByToken($_COOKIE['token']);
      if ($result) {
          $_SESSION['userId'] = $result['idUser'];
          $_SESSION['userName'] = $result['name'];
      }
    }
    require 'header.html';
  ?>
  <div class="container">
  <div class="row align-items-center">
  <?php
    $aListExtPicture = array('JPG', 'PNG', 'GIF', 'PNG');
    $dir      = 'IMG/';
    $dirMini  = 'IMG_MINI/';
    echo showPicture();
    if  (isset ($_POST['send'])){
      if(!empty($_FILES['photo'])) {
          $name = basename($_FILES["photo"]['name']);
          $ext = strtoupper(pathinfo($name,PATHINFO_EXTENSION));
          $newName = pathinfo($name,PATHINFO_FILENAME) . date('_Ymd');
          if(!in_array($ext,$aListExtPicture)) {// Отбросим все файлы - не картинки
            echo "Не картинка";
            return;
          }
          move_uploaded_file($_FILES["photo"]['tmp_name'], $dir . "$newName" . "." . $ext);
          image_resize($dir . "$newName" . "." . $ext, $dirMini . "$newName" . "." . $ext, 100,100,100);
          header("location: /");
      };
    };
  ?>
  </div>
  </div>
  <?php
    if (!empty($_SESSION['userId'])){
      echo creteFormSend();
    } else 
  ?>

</body>
</html>


