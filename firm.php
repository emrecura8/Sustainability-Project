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
   /*if ( !empty($_POST)) {
       extract($_POST) ;
       try {
        $stmt = $db->prepare("INSERT INTO project VALUES (?,?,?,?,?,?,?,?,?,?,?,?)" ) ;
        $stmt->execute([$p_id, $p_name, $p_description, $p_requirement, $p_software, $p_hardware, $p_mediapath]) ;
        $msg = "$p_id $p_name added" ; 
       } catch(PDOException $ex) {
         gotoErrorPage();
       }
   }*/


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
                <li style="color:orange">Projects</li>
                <li><a href="viewinfofirm.php">User Info</a></li>
                <li> <a href="logout.php">Logout</a></li>

            </ul>

        </div>
    </div>
    <!---->

    <!-- partial:index.partial.html -->
    <form action="?" method="post">
    <div class="search">
            <input id="search" type="text" placeholder="Type here" name="query" class="searchTerm">
            <input id="search" type="submit" value="Search Projects/Clear Results" class="searchButton">
        </div>
        <?php 
            if (!empty($_POST['query'])) {
                // Get the search query
                $query = $_POST['query']; 
              
                $sql = "SELECT * FROM project WHERE p_name LIKE '%$query%' OR year LIKE '%$query%'  OR semester LIKE '%$query%'";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
              
                // Check if there are any results
                if (count($result)>0) {
                  // Loop through the results and display them
                    echo "<div class='table-users'>";
                    echo "<div class='header'>Search Results</div>";

                    echo "<table cellspacing='0'>";
                    echo "<tr>";
                    echo "<th>Project Image</th>";
                    echo "<th>Project ID</th>";
                    echo "<th>Project Name</th>";
                    echo "<th width='200'>Description</th>";
                    echo "<th>Requirements</th>";
                    echo "<th>Softwares</th>";
                    echo "<th>Hardware</th>";
                    echo "<th>Year</th>";
                    echo "<th>Semester</th>";
                    echo "<th>Advisor</th>";
                    echo "<th width='230'>Comments</th>";
                    echo "<th>Status</th>";
                    echo "</tr>";
                    foreach ($result as $result): {
                    echo "<tr>";
                    echo "<td><img class='p_mediapath' src='images/{result['p_mediapath'}'></td>";
                    echo "<td>{$result['p_id']}</td>" ;
                    echo "<td>{$result['p_name']}</td>" ;
                    echo "<td>{$result['p_description']}</td>" ;
                    echo "<td>{$result['p_requirement']}</td>" ;
                    echo "<td>{$result['p_hardware']}</td>" ;
                    echo "<td>{$result['year']}</td>" ;
                    echo "<td>{$result['state']}</td>" ;
                    echo "<td>{$result['semester']}</td>" ;
                    echo "<td>{$result['advisor']}</td>";
                    echo "<td>{$result['comment']}</td>" ;
                    echo "<td>{$result['state']}</td>" ;
                    echo "</tr>" ;
                  }
                    endforeach;
                    echo "</table>";
                    echo "</div>";
                } elseif(count($result)==count($projects)) {
                  echo "No results found.";
                }
              }
            ?>
        <div class="table-users">
            <!--DO SOME WORK HERE--->
            <div class="header">Projects <a class="addBtn" href="add_firm.php" title="Edit"><i
                        class="fa-solid fa-plus"></i></i></a></div>

            <table cellspacing="0">
                <tr>
                    <th>Project Image</th>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th width="200">Description</th>
                    <th>Requirements</th>
                    <th>Softwares</th>
                    <th>Hardware</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Advisor</th>
                    <th width="230">Comments</th>
                    <th>Status</th>
                    <th>Update/Delete</th>
                </tr>

                <?php foreach( $project as $projects) : ?>
                <tr>
                    <td><?= $projects["p_mediapath"] ?></td>
                    <td><?= $projects["p_id"] ?></td>
                    <td><?= $projects["p_name"] ?> </td>
                    <td><?= $projects["p_description"] ?></td>
                    <td><?= $projects["p_requirement"] ?></td>
                    <td><?= $projects["p_software"] ?></td>
                    <td><?= $projects["p_hardware"] ?></td>
                    <td><?= $projects["year"] ?></td>
                    <td><?= $projects["semester"] ?></td>
                    <td><?= $projects["advisor"] ?></td>
                    <td><?= $projects["comment"] ?></td>
                    <td><?= $projects["state"] ?></td>
                    <td>
                        <a class="btn"
                            href="update.php?p_name=<?= $projects["p_name"] ?> &self_id=<?= $projects["self_id"] ?> "
                            title="Edit"><i class="fa-solid fa-pen"></i></i></a>
                        <a class="btn" href="?delete=<?= $projects["p_name"] ?> &id=<?= $projects["self_id"]?>"
                            title="Delete"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="13">Project Count: <?= $stmt->rowCount() ?></td>
                </tr>

            </table>
            <!-- partial -->

            <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js'></script><script src="./menu.js"></script>
</body>


</html>