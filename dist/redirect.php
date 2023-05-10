<?php
     session_start() ;
     require "user.php";
     // check if the user authenticated before
     if( !validSession()) {
         header("Location: login.php?error") ;
         exit ; 
     }
     $userData = $_SESSION["user"] ;
     if($userData["type"]==4)
     {
        header("Location: admin.php");
     }
     else if($userData["type"]==2)
     {
        header("Location: firm.php");
     }
     else if($userData["type"]==1 || $userData["type"]==3)
     {
        header("Location: inst_stu.php");
     }
?>