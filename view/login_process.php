<?php
  include_once 'controler/members.php';
  $member = new member; 
  //ověřit uživatele v databázi
  
  if ($member->login($_POST["email"],$_POST["password"]))
    {
    //nastavit session
    $_SESSION['member'] = true;
    $_SESSION['email'] = $_POST["email"];

    //přesměrovat na titulní stránku
    header('Location: ?');

    }
  else
   {
    echo ("<div class=\"login\">\n");
    echo ("<p>Neplatný login nebo heslo. </p>\n");
    echo ("<a href=\"?\" title=\"Titulní stránka\" name=\"Titulní stránka\" class=\"button\">Titulní stránka</a>\n");
    echo ("</div>\n");
   }  
?>