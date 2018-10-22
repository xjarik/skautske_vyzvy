<?php
    $_SESSION['member'] = false;
    $_SESSION['email'] = null;
    $_SESSION['id'] = false;
    $_SESSION['superior'] = false; 
    $_SESSION['admin'] = false;
    //přesměrovat na titulní stránku
    header('Location: ?');
?>