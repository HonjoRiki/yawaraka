<?php
  $user = "honjo";
  $pass = "admin";

  session_start();

  date_default_timezone_set('Asia/Tokyo');

  $comment = $_POST['comment'];
  $day = date("Y/m/d H/i/s");
  try {
    $dbh = new PDO('mysql:host=localhost; dbname=board; charset=utf8', $user, $pass);
    $dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO main (name, day, comment) VALUES (?, ?, ?)";
    $stmt = $dbh -> prepare($sql);

    $stmt -> bindValue(1, $_SESSION['user_name'], PDO::PARAM_STR);
    $stmt -> bindValue(2, $day, PDO::PARAM_STR);
    $stmt -> bindValue(3, $comment, PDO::PARAM_STR);
    $stmt -> execute();

    $dbh = null;
    header('Location: board.php');
    exit();
  } catch(Exception $e) {
    echo "エラー発生：" . htmlspecialchars($e -> getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
  }
?>
