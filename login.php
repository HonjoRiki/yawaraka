<?php
  $user = "honjo";
  $pass = "admin";

  session_start();

  if(isset($_POST['user_name'])){
    $_SESSION['user_name'] = $_POST['user_name'];
  }
  $password = $_POST['password'];

  try {
    $dbh = new PDO('mysql:host=localhost; dbname=board; charset=utf8', $user, $pass);
    $dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM user";
    $stmt = $dbh -> query($sql);
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
      if($_SESSION['user_name'] === $row['user_name']) {
        if($password === $row['password']) {
          header('Location: board.php');
          exit();
        } else {
          echo "ログイン失敗";
        }
      }
    }
  } catch (Exception $e) {
    echo "エラー発生： " . htmlspecialchars($e -> getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
  }
?>
