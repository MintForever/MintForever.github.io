<?php
   session_start();
   unset($_SESSION["type"]);
   unset($_SESSION["login"]);  
   unset($_SESSION["userID"]);  
   header('Location: PersonsForm.html');
?>