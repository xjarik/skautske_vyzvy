<?php                            
  include_once 'controler/members.php';
  $member = new member; 

  // kontrola vkládaných řetězců před vlažením do databáze
  $password = $member->text_check($_POST["password"]);
  $email = $member->text_check(strtolower($_POST["email"]));
 
  echo ("<div class=\"login\"> \n");
 
  // ověřit jedinečnost uživatele
  if ($member->is_exist($email))
    {
     echo ("<p>Uživatel s tímto emailem je již zaregistrován. </p>");
     echo ("<a href=\"?\" title=\"Titulní stránka\" name=\"Titulní stránka\" class=\"button\">Titulní stránka</a>\n");
     echo ("</div>\n");
     echo ("\n</body>\n</html>\n");
     die ();
    }
    
  $email_verification_code = code_generator(20);

  // odeslat požadavek k registraci
  if ($member->register_new($email,$password,$email_verification_code))
    {
     //odeslán email a uživatel přidán do databáze a čeká se na potvrzení administrátorem.
     echo ("<p>Údaje uloženy.</p>
     <p>Odesíláme ti email pro ověření emailové adresy, prosím zkontroluj a potvrď odkazem v emailu. </p>
     <p>Po potvrzení emailu tě kontaktuje administrátor a povolí Ti přístup do systému.</p>");

     // email pro ověření emailové adresy
     $email_address = $email;
     $headers='';
     $headers.='MIME-Version: 1.0'."\r\n";
     $headers.='Content-type: text/html; charset=iso-8859-1'."\r\n";
     $headers.= "From:Skautské výzvy<xjarik@gmail.com>\n";
     $email_text = "<html>
       <head>
	       <title>Skautské výzvy - ověřovací email</title>
         </head>
         <body aria-readonly=\"false\">
          <H1>Skautské výzvy - ověřovací email</H1>
          <p>Potvrzujeme registraci nového uživatele s tímto emailem.</p>
          <p>Pro ověření tohoto emailu klikni na následující odkaz:</p>
          <a href=\"http://http://skautskevyzvy.tode.cz/?page=email_verification&code=".$email_verification_code."\"> Souhlasím. </a></p><br />
          <p>Následně tě někdo z adminů kontaktuje s dalšími instrukcemi.</p>
         </body>
       </html>";
     //echo $email_text; 
     $mail_result = mail($email_address, "Skautské výzvy - ověřovací email", $email_text, $headers);
    if ($mail_result)
      {
        echo ("<p>Byl Ti zaslán email pro ověření tvojí registrace na adresu <u>". $email_address ."</u>. </p>
        <p>Pro potvrzení tvého zájmu <b>klikni na odkaz v emailu!</b></p>");
       }  
    else
      {
        echo ("<p class=\"login\">Chyba: Mail nebyl odeslán, nastala chyba v při odesílání.");
      }  
    }
  else
    {
     echo ("<p>Registrace nového uživatele se nepovedla. </p> \n
     <p>Ověřte prosím zadávané údaje, případně kontaktujte administrátory.</p>");
    }
  
  echo ("<a href=\"?\" title=\"Titulní stránka\" name=\"Titulní stránka\" class=\"button\">Titulní stránka</a>\n");
  echo ("</div>\n");
?>
