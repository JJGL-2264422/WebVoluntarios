<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: ../vista/formularios/login.php");
   }
?>