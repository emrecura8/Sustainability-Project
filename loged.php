<?php
  session_start() ;
  require "user.php";
  // check if the user authenticated before
  if( !validSession()) {
      header("Location: login.php?error") ;
      exit ; 
  }
 
  $userData = $_SESSION["user"] ;
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sensitive Information</h1>
    <h3>Welcome <?= var_dump($userData) ?></h3>
    
    <div>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>