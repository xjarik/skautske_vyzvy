<?php
  include_once 'controler/members.php';
  $member = new member; 

  if ($_POST["Smazat"]=="Smazat") 
    {
     $member->delete_new_member($_POST["id"]);
    }
  header('Location: ?page=members_administration');
?>