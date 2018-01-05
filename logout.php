<?php
  $user = "honjo";
  $pass = "admin";

  $_SESSION = array();
  session_destroy();
  header('Location: index.html');

?>
