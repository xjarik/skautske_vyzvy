<?php
function variables_from_get(&$page) 
{
  if( isset($_GET['page']) && !empty($_GET['page']) )  
    {$page = preg_replace('[^0-9a-z\-]', '', $_GET['page']);}
  else {$page = "";} 
}

// Funkce, která do prostředního sloupce vloží text. 
// Pokud je zadaná hodnota $_GET['page'], tak ji vyčistí od nebezpečných znaků a pokusí se najít odkazovanou stránku.
function page_from_get() 
{
 // Test zda je zadána hodnota v $_GET['page']
 if( isset($_GET['page']) && !empty($_GET['page']) )  
   {
    // Zachovám alespoň podrtržítko - původně $mypage=eregi_replace('[^0-9a-z\-\_]', '', $_GET['page']);
    $mypage = preg_replace('[^0-9a-z\-]', '', $_GET['page']);

    $directories[]="view";
    $fileexist = false;
    
    foreach ($directories as &$directory)
      {
       $mypage_fullpath = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . /*$directory . DIRECTORY_SEPARATOR . */ $mypage . '.php';
       if( file_exists($mypage_fullpath) )
         {
          require $mypage_fullpath;
          $fileexist = true;
          break;
         }
      }
      
    if (false == $fileexist)
      {  
       // Případné zaznamenání chyb
       echo 'ERROR 404: Stránka ' . $mypage . ' neexistuje.';
      }
   }
 // Zde může být co se má načíst, pokud není žádná hodnota v $_GET['page'] : 

}

?>
