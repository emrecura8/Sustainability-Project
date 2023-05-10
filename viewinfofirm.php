<?php
    require "db.php";
    require "user.php";
   session_start() ;
   
    // check if the user authenticated before
    if( !validSession()) {
        header("Location: login.php?error") ;
        exit ; 
    }
    
    $userdata=$_SESSION["user"];    
    $fid=$userdata["id"];
    $fmail=$userdata["email"];
    $fname=$userdata["firm_name"];
    $fusername=$userdata["firm_username"];
    $fpassword=$userdata["firm_password"];  
    $fcity=$userdata["city"];
    $fdistrict=$userdata["district"];
    $faddress=$userdata["address"]; 

//
//


   if ( isset($_GET["update"])) {
      $projects = getProject($_GET["update"]) ;
      $msg = "{$projects["p_id"]}  {$projects["p_name"]} updated." ;
  }


   // DELETE PROJECT
   if ( isset($_GET["delete"])) {
       $p_name = $_GET["delete"] ;
       $projects = getProject($p_name) ;
       try {
          $stmt = $db->prepare("DELETE FROM project where p_name = ?") ;
          $stmt->execute([$p_name]) ;
          //$msg = "{$project["p_id"]} {$project["p_name"]} deleted" ;
       } catch(PDOException $ex) {
            gotoErrorPage();
       } 
   }

   // INSERT a Game
   if ( !empty($_POST)) {
       extract($_POST) ;
       try {
        $stmt = $db->prepare("INSERT INTO project VALUES (?,?,?,?,?,?,?,?,?,?,?,?)" ) ;
        $stmt->execute([$p_id, $p_name, $p_description, $p_requirement, $p_software, $p_hardware, $p_mediapath]) ;
        $msg = "$p_id $p_name added" ; 
       } catch(PDOException $ex) {
         gotoErrorPage();
       }
   }


   // Edit Message
   if ( isset($_GET["edit"])) {
       $project = getProject($_GET["edit"]) ;
       $msg = "{$project["p_id"]}  {$project["p_name"]} updated." ;
   }

   //read the projects from db
   try {    
    $stmt = $db->prepare("select * from project where p_id={$userdata["id"]}");
    $stmt->execute([]);
    $project = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
 } catch( PDOException $ex) {
     gotoErrorPage();
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Project Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="headermenu">
        <div class="menu">
            <ul>

                <li><a href="firm.php">Projects</a></li>
                <li style="color:orange">User Info</li>
                <li> <a href="logout.php">Logout</a></li>

            </ul>

        </div>
    </div>
    <div class="table-users">
        <div class="header">Info <a class="" href="edituser.php" title="Edit"><i class="fa-solid fa-user"></i></i></a>
        </div>
    </div>

    <label for="name">Firm Mail:</label>
    <input type="text" id="name" name="name" value="<?= $fmail ?>" readonly><br>

    <label for="email">Firm Name:</label>
    <input type="text" id="email" name="email" value="<?= $fname ?>" readonly><br>

    <label for="password">Firm Username:</label>
    <input type="text" id="password" name="password" value="<?= $fusername ?>" readonly><br>

    <label for="telephone">Firm Password:</label>
    <input type="text" id="telephone" name="telephone" value="<?= $fpassword ?>" readonly><br>

    <label for="website">City:</label>
    <input type="text" id="website" name="website" value="<?= $fcity ?>" readonly><br>

    <label for="message">District:</label>
    <input type="text" id="message" name="message" value="<?= $fdistrict ?>" readonly><br>

    <label for="message">Address:</label>
    <input type="text" id="message" name="message" value="<?= $faddress ?>" readonly><br>

    <label for="message">ID:</label>
    <input type="text" id="message" name="message" value="<?= $fcity ?>" readonly><br>
    <!---->

    <!-- partial:index.partial.html -->

    <!-- partial -->

    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js'></script>
    <script src="./menu.js"></script>
</body>

</html>