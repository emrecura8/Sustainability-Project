<?php
require "db.php";

if ( isset($_GET["delete"])) {
   $p_id = $_GET["delete"] ;
   $projects = getProject($p_id) ;
   try {
      $stmt = $db->prepare("DELETE FROM project where p_id = ?") ;
      $stmt->execute([$p_id]) ;
      //$msg = "{$project["p_name"]} deleted" ;
   } catch(PDOException $ex) {
        gotoErrorPage();
   } 
}
   if ( isset($_GET["update"])) {
      $projects = getProject($_GET["update"]) ;
      $msg = "{$projects["p_id"]}  {$projects["p_name"]} updated." ;
  }

  try {
   $rs = $db->query("select * from project") ;
   $project = $rs->fetchAll(PDO::FETCH_ASSOC) ;
} catch( PDOException $ex) {
    gotoErrorPage();
}

   // DELETE
   if ( isset($_GET["delete"])) {
       $p_id = $_GET["delete"] ;
       $projects = getProject($p_id) ;
       try {
          $stmt = $db->prepare("DELETE FROM project where p_id = ?") ;
          $stmt->execute([$p_id]) ;
          //$msg = "{$project["p_id"]} {$project["p_name"]} deleted" ;
       } catch(PDOException $ex) {
            gotoErrorPage();
       } 
   }

   // Edit Message
   if ( isset($_GET["edit"])) {
       $project = getProject($_GET["edit"]) ;
       $msg = "{$project["p_id"]}  {$project["p_name"]} updated." ;
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Project Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./style.css">
    <script src="assets/js/jquery-3.6.1.min.js"></script>

</head>

<body>
<div class="headermenu">
        <div class="menu">
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="register copy.php">Register</a></li>
                <li style="color:orange">List Projects</a></li>

            </ul>

        </div>
    </div>
    <!-- partial:index.partial.html -->
    <form action="?" method="post">
        <form action="users.php" method="post">
            <div class="search">
                <input id="search" type="text" placeholder="Type here" name="query" class="searchTerm">
                <input id="submit" type="submit" value="Search Projects/Clear Results" class="searchButton">
            </div>
            <?php 
            if (!empty($_POST['query'])) {
                // Get the search query
                $query = $_POST['query'];
                $query = htmlspecialchars($query);  
              
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
                } elseif(count($count)==count($projects)) {
                  echo "No results found.";
                }
              }
            ?>
        </form>
        <div class="table-users">
            <div class="header">Projects</div>

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
                </tr>

                <?php foreach( $project as $projects) : ?>
                <tr>
                    <td><img src="images/<?= $projects["p_mediapath"] ?>"></td>
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
                </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="12">Project Count: <?= $rs->rowCount() ?></td>
                </tr>

            </table>
            <!-- partial -->

</body>

</html>