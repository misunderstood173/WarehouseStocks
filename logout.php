<?php
    session_start();
    if (isset($_SESSION['user']) && isset($_SESSION["ID"])) {
      unset($_SESSION['user']);
      unset($_SESSION["ID"]);
      if (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
      }
      echo 'Successfully logged out.';
    }
    else {
      echo 'You are not logged in!';
    }
    echo '<br>';
    echo '<a href=index.html>Go to homepage</a>';
 ?>
