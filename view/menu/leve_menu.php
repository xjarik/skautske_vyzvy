<?php
  if ($_SESSION['admin'] == TRUE)
    {
      echo ('<a href="?page=members_administration" id="menu" title="Administrace hráčů" name="Administrace hráčů" class="button">Administrace hráčů</a>');
    }
  echo ('<a href="?page=logout_process" id="menu" title="Odhlásit se" name="Odhlásit se" class="button">Odhlásit se</a>');

/*
     - menu
     - natažení odkazované stránky
       -- přehled výzev
       -- výzva - detail
       -- výzva nalezena - odkaz z QRcode
       -- administrace potvrzování splnění úkolů
       -- scoreboard
       -- administrace zadání výzvy
 
*/
  
?>

