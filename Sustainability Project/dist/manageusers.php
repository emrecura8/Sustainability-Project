<?php


    require "db.php";
    require "user.php";
    session_start();
    //var_dump($_SESSION);
    $userdata=$_SESSION["user"];    
    // check if the user authenticated before


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
    $stmt = $db->prepare("select * from project");
    $stmt->execute([]);
    $project = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
 } catch( PDOException $ex) {
     gotoErrorPage();
 }

 //DELETE STUDENT
 if ( isset($_GET["deleteStu"])) {
    $stu_id = $_GET["deleteStu"] ;
    $stu = getStuUser($stu_id) ;
    try {
       $stmt4 = $db->prepare("DELETE FROM stu_user where id = ?") ;
       $stmt4->execute([$stu_id]) ;
       //$msg = "{$project["p_id"]} {$project["p_name"]} deleted" ;
    } catch(PDOException $ex) {
         gotoErrorPage();
    } 
}


    //read student informations from db
    try {
        $stmt3 = $db->prepare("select * from stu_user");
        $stmt3->execute();
        $students = $stmt3->fetchAll(PDO::FETCH_ASSOC) ;
     } catch( PDOException $ex) {
         gotoErrorPage();
     }
   

     //read instructor informations from db
    try {
        $stmt5 = $db->prepare("select * from inst_user");
        $stmt5->execute();
        $instructors = $stmt5->fetchAll(PDO::FETCH_ASSOC) ;
     } catch( PDOException $ex) {
         gotoErrorPage();
     }
     //var_dump($instructors);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    </div>
    <meta charset="UTF-8">
    <title>Project Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <div class="headermenu">
        <div class="menu">
            <ul>
                <li><a href="admin.php">Projects</a></li>
                <li><a href="viewinfoadmin.php">User Info</a></li>
                <li style="color:orange">Manage Users</li>
                <li> <a href="logout.php">Logout</a></li>

            </ul>

        </div>
    </div>
    </div>
    <!---->
    <div class="table-users">
        <div class="header">Students</div>

        <table cellspacing="0">
            <th>email</th>
            <th>Name and Surname</th>
            <th>Username</th>
            <th>Password</th>
            <th>Student ID</th>
            <th>Manage Student Info</th>
            <?php
                            foreach($students as $stu)
                            {
                                echo" <tr>";
                                echo"<td>";
                                echo"{$stu["email"]}";
                                echo"</td>";
                                echo"<td>";
                                echo"{$stu["name"]}";
                                echo"</td>";
                                echo"<td>";
                                echo"{$stu["username"]}";
                                echo"</td>";
                                echo"<td>";
                                echo"{$stu["password"]}";
                                echo"</td>";
                                echo"<td>";
                                echo"{$stu["id"]}";
                                echo"</td>";
                                echo "<td>";
                                echo"<a class='btn' href=\"?deleteStu={$stu["id"]}\" title='Delete'><i
                                class='fa-solid fa-trash-can'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                                
                            }                        
                        ?>

        </table>
    </div>
    </div>




    <div class="table-users">
        <div class="header">Instructors</div>

        <table cellspacing="0">
            <th>email</th>
            <th>Name and Surname</th>
            <th>Username</th>
            <th>Password</th>
            <th>Instructor ID</th>
            <th>Assigned Student Name</th>
            <th>Assign to student</th>
            <?php
                            foreach($instructors as $teach)
                            {
                                echo" <tr>";
                                echo"<td>";
                                echo"{$teach["email"]}";
                                echo"</td>";
                                echo"<td>";
                                echo"{$teach["name"]}";
                                echo"</td>";
                                echo"<td>";
                                echo"{$teach["username"]}";
                                echo"</td>";
                                echo"<td>";
                                echo"{$teach["password"]}";
                                echo"</td>";
                                echo"<td>";
                                echo"{$teach["id"]}";
                               
                                if($teach["advisor_status"]==0)
                                {
                                    echo"<td>";
                                    echo"Not an advisor";
                                    echo"</td>";
                                }
                                else
                                {
                                    echo"<td>";
                                    echo"{$teach["student_advised"]}";
                                    echo"</td>";
                                    
                                }
                                echo "<td>";
                                echo"<a class='btn' href=\"assignInst.php?instId={$teach["id"]}\"title='Delete'><i
                                class='fa-solid fa-plus'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                               
                                
                            }                        
                        ?>

        </table>
    </div>
    </div>
    <!-- partial:index.partial.html -->
    <form action="?" method="post">

            <!-- partial -->

</body>


</html>