<?php

include_once 'lib/database.php';

class member
{
  private $db;

public function __construct()
  {
   $this->db = new database;
   return true;
  }
 
public function __destruct()
  {
   return true;
  }

public function login($login,$password)
  {
   $res_active = $this->db->conn->query("SELECT `id`, `superior`, `admin` FROM `members` WHERE `email` LIKE '". $login . "' AND `password` LIKE '" . $password . "'");
   if ($this->db->conn->connect_errno) 
     {
      return false;
     }

   if ($res_active->num_rows == 1)
     {
     $member = $res_active->fetch_assoc(); 
     $_SESSION['member'] = true;
     $_SESSION['email'] = $login;
     $_SESSION['id'] = $member['id'];
     $_SESSION['superior'] = $member['superior'];
     $_SESSION['admin'] = $member['admin'];
     return true;
     }
   else 
     {
     return false;    
     }

  }
  
public function is_exist($email)
  {
   $res_new = $this->db->conn->query("SELECT `id` FROM `members_newly_regitered` WHERE `email`='" . $email  . "'");
   $res_active = $this->db->conn->query("SELECT `id` FROM `members` WHERE `email`='" . $email  . "'");
   if (($res_new->num_rows > 0) OR ($res_active->num_rows > 0))
     {
     return true;
     }
   else 
     {
     return false;    
     }
  }

public function register_new($email,$password,$email_verification_code)
  {
   // insert into database:
   $sql = "INSERT INTO `members_newly_regitered` (email, password,verification_code) VALUES ('" . $email . "', '" . $password . "', '" . $email_verification_code . "')";
   $res = $this->db->conn->query($sql);
     
   if ($this->db->conn->connect_errno) 
    {
     return false;
    }
   return true;
  }

public function list_of_members_newly_regitered()
  {
  // get array of members newly registered
   $res = $this->db->conn->query("SELECT `id`,`email`,`verified` FROM `members_newly_regitered`");
   if ($res->num_rows > 0)
     {
      while ($row = $res->fetch_assoc()) 
        {
         $members_list[] = $row;
        }
      return $members_list;
     }
    else
     {
      return false;
     } 
  }   
  
public function list_of_active_members()
  {
  // get array of members
   $res = $this->db->conn->query("SELECT `id`,`email` FROM `members`");
   if ($res->num_rows > 0)
     {
      while ($row = $res->fetch_assoc()) 
       {
        $members_list[] = $row;
       }
      return $members_list;
     }
    else
     {
      return false;
     } 
  }   

//approve new player means move new player from table players_new to table players
public function approve_new_member($id)
  {
  //get new member information
  $res = $this->db->conn->query("SELECT `id`,`email`,`password` FROM `members_newly_regitered` WHERE `id`='" . $id . "'");
  if ($this->db->conn->connect_errno) 
    {
     return false;
    }
  while ($row = $res->fetch_assoc()) 
    {
     $new_member = $row;
    }
  // verification if member founded
  if ($res->num_rows != 1)
    {
     return false;
    }
    
  //insert approved member to active members table  
  $sql = "INSERT INTO `members` (email, password) VALUES ('" . $new_member["email"] . "', '" . $new_member["password"] . "')";
  $res = $this->db->conn->query($sql);
  if ($this->db->conn->connect_errno) 
    {
     return false;
    }

  if (!$this->delete_new_member($id))
    {
     return false;
    }
  }   

public function delete_new_member($id)
  {
  $this->db->conn->query("DELETE FROM `members_newly_regitered` WHERE `id`='" . $id . "' LIMIT 1");
  if ($this->db->conn->connect_errno) 
   {
    return false;
   }
   return true;
  }   
  
public function text_check($input_text)
  {
    return  $this->db->text_check($input_text);
  }
  
}

?>