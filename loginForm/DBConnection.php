<?php
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $baza = 'tor_kartingowy';
  
  $link = mysqli_connect($dbhost, $dbuser, $dbpass, $baza);
  $_SESSION['link']= $link;
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  if(!$link) echo '<b> przerwane połączenie </b>';
  if(!mysqli_select_db($link, $baza)) echo 'nie wybrano bazy';

?>
