<?php
  include_once '../controler/lib/database.php';

  $db = new database;
  $db->test();
  if ($db->test()) {echo ("připojení databáze ....... OK!");}
  
// vytvořit tabulku nově zaregistrovaných hráčů
   $sql = "CREATE TABLE IF NOT EXISTS members_newly_regitered (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
password VARCHAR(30) NOT NULL,
verification_code VARCHAR(32) NOT NULL,
verified BOOLEAN DEFAULT false,
reg_date TIMESTAMP
)";
   $res = $db->conn->query($sql);
   if ($db->conn->connect_errno) 
    {
     echo ("Database connection failed.");
    }
    echo ("Tabulka members_newly_regitered vytvořena.");
    
// vytvořit tabulku potvrzených hráčů
   $sql = "CREATE TABLE IF NOT EXISTS members (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
password VARCHAR(30) NOT NULL,
superior BOOLEAN DEFAULT false,
admin BOOLEAN DEFAULT false,
reg_date TIMESTAMP
)";
   $res = $db->conn->query($sql);
   if ($db->conn->connect_errno) 
    {
     echo ("Database connection failed.");
    }
    echo ("Tabulka members vytvořena.");
    

// vytvořit tabulku výzvy
   $sql = "CREATE TABLE IF NOT EXISTS challenges (
id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
active BOOLEAN DEFAULT true,
gained_rating INT(8),
dane_rating INT(8),
description TEXT,
location TEXT,
challenge TEXT,
code VARCHAR(32),
author_id INT(6) UNSIGNED NOT NULL,
create_datetime TIMESTAMP
)";
   $res = $db->conn->query($sql);
   if ($db->conn->connect_errno) 
    {
     echo ("Database connection failed.");
    }
    echo ("Tabulka challenges vytvořena.");
    

// vytvořit tabulku nalezené
   $sql = "CREATE TABLE IF NOT EXISTS done (
member_id INT(6) UNSIGNED NOT NULL,
challenge_id INT(8) UNSIGNED NOT NULL,
rating INT(8),
datetime TIMESTAMP
)";
   $res = $db->conn->query($sql);
   if ($db->conn->connect_errno) 
    {
     echo ("Database connection failed.");
    }
    echo ("Tabulka done vytvořena.");
    

// vytvořit tabulku splněné
   $sql = "CREATE TABLE IF NOT EXISTS gained (
member_id INT(6) UNSIGNED NOT NULL,
challenge_id INT(8) UNSIGNED NOT NULL,
datetime TIMESTAMP
)";
   $res = $db->conn->query($sql);
   if ($db->conn->connect_errno) 
    {
     echo ("Database connection failed.");
    }
    echo ("Tabulka gained vytvořena.");
    
?>



<html>
  <body>
    <br><br><br>
    Provedeno! :)  
  
    <br><br><br><br><br>  
  </body>
</html>
