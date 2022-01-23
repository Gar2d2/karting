<?php
  $dbhost = 'localhost';
  $dbuser = 'torkartingowy999_torkartingowy';
  $dbpass = 'jzfw3d3uk5';
  $baza = 'torkartingowy999_torkartingowy';
  
  $link = mysqli_connect($dbhost, $dbuser, $dbpass, $baza);
  $_SESSION['link']= $link;
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  if(!$link) echo '<b> przerwane połączenie </b>';
  if(!mysqli_select_db($link, $baza)) echo 'nie wybrano bazy';

?>
