<?php
  include_once 'controler/members.php';
  $member = new member; 


if (isset($_POST["Schvalit"]) && $_POST["Schvalit"]=="Schvalit") 
 {
  $member->approve_new_member($_POST["id"]);
  header('Location: ?page=members_administration');
 }
else
{
 if (isset($_POST["Odstranit"]) && $_POST["Odstranit"]=="Odstranit") 
  {
   echo "<br />";
   echo $_POST["id"];
   echo "&nbsp;&nbsp;";
   echo $_POST["email"];
   echo "<br /><br />";
   echo "Opravdu tuto registraci smazat?<br /><br />";
   echo '<form action="?page=delete_new_member" method="post" name="approve_form">';
   echo '<input type="hidden" name="id" value="' . $_POST["id"] . '">';
   echo '<input type="hidden" name="email" value="' . $_POST["email"] . '"><br />';
   echo '<button type="submit" name="Smazat" value="Smazat">Smazat</button>';
   echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
   echo '<button type="submit" name="Zpět" value="Zpět">Zpět</button></form>';
  }
  else
  {
  echo "Chybná data z formuláře!";
  }
}
?>