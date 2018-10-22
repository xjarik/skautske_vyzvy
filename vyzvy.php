<?php 
  session_start();
  if (!isset($_SESSION['member'])) {$_SESSION['member'] = false;}

  /***  Používané proměnné sessins:
  ***    $_SESSION['member'] = true; (true = logged in)
  ***    $_SESSION['email'];
  ***    $_SESSION['id'];
  ***    $_SESSION['superior'];
  ***    $_SESSION['admin'];
  ***/

  include_once 'view/lib/view_lib.php';
  $page="";
  variables_from_get($page);
?>


<!doctype html>
<html>
<head>
  <title>Skautské výzvy - 1. oddíl Cesta Čebín!</title>
  <link rel="stylesheet" href="view/styles/styles.css">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
 <div class="vycentrovat">
   
  <div class="zahlavi">
    <h1>Skautské výzvy - 1. oddíl Cesta Čebín!</h1>  
  </div>


  <?php

   /*** přihlašovaní ***/
   if ($_SESSION['member'] != TRUE) 
    {
     switch ($page) {
      case "register":
          include "view/register.php";
          break;
      case "login":
          include "view/login.php";;
          break;
      case "register_process":
          include "view/register_process.php";
          break;
      case "login_process":
          include "view/login_process.php";
          break;
      default: include "view/login.php";
      }
     echo ("<br><br><br>\n</body>\n</html>\n");
     die();
    }
  
   /*** levé menu ***/  
   echo ('<div class="leve_menu">');
   include 'view/menu/leve_menu.php';
   echo ('</div>');  
  
   /*** obsah ***/ 
   echo ('<div class="obsah">');
   page_from_get();
   echo ('</div>');

  ?>
 </div>
</body>
</html>
