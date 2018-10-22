<?php
  include_once 'controler/members.php';
  $member = new member; 

  echo ("<h3>Noví hráči:</h3>");
  $members_list = $member->list_of_members_newly_regitered();
  if (is_array($members_list)) 
    {
     foreach ($members_list as $player)
     {
      echo '<form action="?page=approve_new_member" method="post" name="approve_form">';
      echo $player["id"];
      echo "&nbsp;&nbsp;";
      echo $player["email"];
      echo "&nbsp;&nbsp;";
      echo '<input type="hidden" name="id" value="' . $player["id"] . '">
      <input type="hidden" name="email" value="' . $player["email"] . '">
      <button type="submit" name="Schvalit" value="Schvalit">Schválit</button>&nbsp;&nbsp;<button type="submit" name="Odstranit" value="Odstranit">Odstranit</button></form>';
      echo "<br />";
     }
    } 


  echo ("<h3>Přehled hráčů:</h3>");
  $members_list = $member->list_of_active_members();
  if (is_array($members_list)) 
    {
     foreach ($members_list as $player)
      {
       echo $player["id"];
       echo "&nbsp;&nbsp;";
       echo $player["email"];
       echo "<br />";
      }
    }
?>