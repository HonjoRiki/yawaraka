<?php
  $user = "honjo";
  $pass = "admin";

  session_start();
  $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>やわらか掲示板</title>
    <link rel="stylesheet" href="board.css">
  </head>
  <body>
    <div class="title">
      <h1>やわらか掲示板 メインページ</h1>
      <p>あなたの名前：<?php echo $_SESSION['user_name']; ?></p>
      <form class="comment_form" action="post.php" method="post">
        コメント：
        <textarea name="comment" rows="8" cols="80" maxlength="140"></textarea>
        <br>
        <input type="submit" value="コメントする"><br>

        <a href="logout.php">ログアウト</a>
      </form>
    </div>
    <div class="main">
      <?php

        try {
          $dbh = new PDO('mysql:host=localhost; dbname=board; charset=utf8', $user, $pass);
          $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $sql = "SELECT * FROM main";
          $stmt = $dbh -> query($sql);
          $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

          foreach ($result as $row) {
            echo "<div class='comment_box'>";
              echo "<p>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($row['day'], ENT_QUOTES, 'UTF-8') . "</p>";
              echo nl2br(htmlspecialchars($row['comment'], ENT_QUOTES, 'UTF-8'));
            echo "</div>";
          }
          $dbh = null;
        } catch(Exception $e) {
          echo "エラー発生： " . htmlspecialchars($e -> getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
          die();
        }
      ?>
    </div>
  </body>
</html>
