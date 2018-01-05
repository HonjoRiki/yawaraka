<?php

  $user = "honjo";
  $pass = "admin";

  session_start();

  if(isset($_POST['user_name'])){
    $_SESSION['user_name'] = $_POST['user_name'];
  }
  $address = $_POST['address'];
  $password = $_POST['password'];
  $pass2 = $_POST['pass2'];

  if($password === $pass2) {
    try {
      $dbh = new PDO('mysql:host=localhost; dbname=board; charset=utf8', $user, $pass);
      $dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO user (user_name, address, password) VALUES (?, ?, ?)";
      $stmt = $dbh -> prepare($sql);

      $stmt -> bindValue(1, $_SESSION['user_name'], PDO::PARAM_STR);
      $stmt -> bindValue(2, $address, PDO::PARAM_STR);
      $stmt -> bindValue(3, $password, PDO::PARAM_STR);
      $stmt -> execute();

      $dbh = null;
      header('Location: board.php');
      exit();
    } catch(Exception $e) {
      echo "エラー発生：" . htmlspecialchars($e -> getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
      die();
    }
  } else if(password != pass2) {
    echo "パスワードが違います。";
  }

?>
