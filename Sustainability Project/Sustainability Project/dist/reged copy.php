<?php
   require "db.php";
   require "register copy.php";
   var_dump($_POST);
   extract($_POST);
   
   if(isset($submit))
   {
       if(preg_match("/$radio/", "Instructor"))
       {
           
           $stmt=$db->prepare("insert into inst_user(email, name, username, password, type) values(?,?,?,?,?)");
           $stmt->execute([$email, $name, $user, $password, 3]);
           header("Location:register.php");
       
       }
       else if(preg_match("/$radio/", "Project Advisor"))
       {
           //This is a special Instructor type. Update the project table later
          
           $stmt=$db->prepare("insert into inst_user(email, name, username, password, type) values(?,?,?,?,?)");
           $stmt->execute([$email, $name, $user, $password, 3]);
           header("Location:register copy.php");
       }
       else if(preg_match("/$radio/", " Student"))
       {
           
           $stmt=$db->prepare("insert into stu_user(email, name, username, password, type) values(?,?,?,?,?)");
           $stmt->execute([$email, $name, $user, $password, 1]);
           header("Location:register copy.php");
       }
       else if(preg_match("/$radio/", " Admin"))
       {
          
           $stmt=$db->prepare("insert into admin(email, name, username, password, type) values(?,?,?,?,?)");
           $stmt->execute([$email, $name, $user, $password, 4]);
           header("Location:register copy.php");
       }
   }
   /*if(preg_match("/$radio/", "Instructor"))
   {
       $type=3;
       $stmt=$db->prepare("insert into inst_user(email, name, username, password, type) values(?,?,?,?,?)");
       $stmt->execute([$email, $name, $user, $password, 3]);
       header("Location:register.php");
       
   }
   else if(preg_match("/$radio/", "Project Advisor"))
   {
       //This is a special Instructor type. Update the project table later
       $type=3;
       $stmt=$db->prepare("insert into inst_user(email, name, username, password, type) values(?,?,?,?,?)");
       $stmt->execute([$email, $name, $user, $password, 3]);
       header("Location:register.php");
   }
   else if(preg_match("/$radio/", " Student"))
   {
       $type=3;
       $stmt=$db->prepare("insert into inst_user(email, name, username, password, type) values(?,?,?,?,?)");
       $stmt->execute([$email, $name, $user, $password, 1]);
       header("Location:register.php");
   }
   else if(preg_match("/$radio/", " Admin"))
   {
       $type=3;
       $stmt=$db->prepare("insert into inst_user(email, name, username, password, type) values(?,?,?,?,?)");
       $stmt->execute([$email, $name, $user, $password, 4]);
       header("Location:register.php");
   }
   //$stmt=$db->prepare("insert")*/
   else if(isset($submit2))
   {
           
           $stmt=$db->prepare("insert into firm_user(email, firm_name, firm_username, firm_password, city, district, address, type) values(?,?,?,?,?,?,?,?)");
           $stmt->execute([$email2, $firm, $user2, $password2, $city, $dist, $add,  2]);
           header("Location:register copy.php");
   }
?>