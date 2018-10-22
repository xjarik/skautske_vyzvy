<?php
class database
{
public $conn;

// metoda pro připojení k databázi
protected function db_connect()      
  {
//   include "../_pristupy/databaze.php";
   include "_pristupy/databaze.php";
   $this->conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
   
   // check connection 
   if ($this->conn->connect_errno) 
     {
      die("Database connection failed.". $this->conn->connect_error);
      return false; 
     }
   return true;
  }

public function __construct()
  {
    $this->db_connect();
   return true;
  }
 
public function __destruct()
  {
    $this->conn->close();
  }

public function test()
  {
//   echo "test databaze je ok!<br />";
   return true;
  }

// funkce na kontrolu textu před vkládáním do databáze
public function text_check($input_text)
  {
   // test zda je vůbec zadána hodnota  
   if (isset($input_text) && !empty($input_text) )
   {
    //odstranění mezer v textu
    $verified_text = preg_replace('/\s\s+/', ' ', $input_text);
    //zachovám alespoň podrtržítko - alternativně $verified_text=preg_replace('[^0-9a-z\-\_]', '', $verified_text);
    $verified_text=preg_replace('[^0-9a-z\-]', '', $verified_text);

    return $verified_text;  
   }
  }  
} 


//vygeneruje variaci náhodných znaků z rozsahu $characters o požadované délce $length
function code_generator($length) 
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $characters_amount = strlen($characters);
  $code_string = '';
  for ($i = 0; $i < $length; $i++) 
  {
    $code_string .= $characters[rand(0, $characters_amount - 1)];
  }
  return $code_string;
}


?>