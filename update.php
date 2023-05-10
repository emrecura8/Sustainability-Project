<?php

require "db.php" ;
require "user.php";
session_start();  
// check if the user authenticated before
if( !validSession()) 
{
    header("Location: login.php?error") ;
    exit ; 
}
$userdata=$_SESSION["user"];
$stmt2 = $db->prepare("SELECT p_name FROM project WHERE p_id= ?") ;
$stmt2->execute([$userdata["id"]]);
$oldName = $stmt2->fetch(PDO::FETCH_ASSOC) ;

        
   
   if ( !empty($_POST)) 
   {
        extract($_POST) ;
        
        if($userdata["type"]==4)
        {
            try {
                $sql = "UPDATE project SET p_name= ? , p_description = ?, p_requirement = ?, p_software = ?, p_hardware = ?, 
                 state = ?, comment = ?, semester = ?, advisor = ?,  p_mediapath= ?  WHERE self_id = ?";
                $stmt = $db->prepare($sql) ;
                $stmt->execute([ $p_name, $p_description, $p_requirement,  $p_software, $p_hardware, $state,  $comment, $semester,  $advisor,  $p_mediapath,  $self_id]) ;
                
                header("Location: admin.php") ;
                
                exit;
            }     
            catch(PDOException $ex) {
              gotoErrorPage2() ;
            }
        }
        else  if($userdata["type"]==1)
        {
            try {
                $stmt = $db->prepare("UPDATE project SET p_name= ? , p_description = ?, p_requirement = ?, p_software = ?, p_hardware = ?, 
                Group_Members=?,  p_mediapath= ?  WHERE self_id = ?") ;
                $stmt->execute([ $p_name, $p_description, $p_requirement,  $p_software, $p_hardware,
                  $group,  $p_mediapath,  $self_id]) ;
                
                header("Location: inst_stu.php") ;
                
                exit ;
            }     
            catch(PDOException $ex) {
              gotoErrorPage2() ;
            }
        }

        else  if($userdata["type"]==3)
        {
            if($userdata["advisor_status"]==1)
            {
                try {
                    $stmt = $db->prepare("UPDATE project SET p_name= ? , p_description = ?, p_requirement = ?, p_software = ?, p_hardware = ? 
                    , year = ?, comment = ?, semester = ?,  p_mediapath= ?  WHERE self_id = ?") ;
                    $stmt->execute([ $p_name, $p_description, $p_requirement,  $p_software, $p_hardware,
                     $year,  $comment, $semester, $p_mediapath,  $self_id]) ;
                    
                    header("Location: inst_stu.php") ;
                    
                    exit ;
                }     
                catch(PDOException $ex) {
                  gotoErrorPage2() ;
                }
            }
            else if($userdata["advisor_status"]==0)
            {
                try 
                {
                    
                    
                    $stmt = $db->prepare("UPDATE project SET p_name= ? , p_description = ?, p_requirement = ?, p_software = ?, p_hardware = ? 
                    , year = ?, semester = ?,  p_mediapath= ?  WHERE  self_id = ?") ;
                    $stmt->execute([$p_name, $p_description, $p_requirement,  $p_software, $p_hardware,
                       $year, $semester, $p_mediapath,  $self_id]) ;
                    //header("Location: index2.php?update=$p_id") ;
                    header("Location: inst_stu.php") ;
                    
                    exit ;
                }     
                catch(PDOException $ex) {
                  gotoErrorPage3() ;
                }
            }
           
        }
        else  if($userdata["type"]==2)
        {
            try {
                $stmt = $db->prepare("UPDATE project SET 
                p_name=?, p_description=?, p_requirement=?,	p_software=?,p_hardware=?, year=?, state=?, comment=?,semester=?,advisor=?,	
                Group_Members=?,p_mediapath=?  WHERE self_id = ?") ;
                $stmt->execute([ $p_name, $p_description, $p_requirement,  $p_software, $p_hardware,
                $year, $state, $comment, $semester, $advisor, $group, $p_mediapath,  $self_id]) ;
                
                header("Location: firm.php") ;
                
                exit ;
            }     
            catch(PDOException $ex) {
              gotoErrorPage2() ;
            }
        }
   
    }


   //$p_id = $_GET["p_id"] ;
   //
   
   $id=$_GET["self_id"] ;
   try {
     $stmt = $db->prepare("SELECT * FROM project WHERE self_id = ?") ;
     $stmt->execute([$id]) ;
     $projects = $stmt->fetch(PDO::FETCH_ASSOC) ;
   } catch( PDOException $ex) {
        gotoErrorPage() ;
        
   }

   
   
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800"'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css”>
    <link rel="stylesheet" href="./form.css">
</head>

<?php
if($userdata["type"]==1){
?>

<main id="main" class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-offset-3 col-lg-6">
            <div class="m-b-md text-center">
                <h1 id="title">Update Project</h1>
                <p id="description" class="description" class="text-center">Update your project information!
                </p>
            </div>
            <form method="post" action="" id="survey-form" name="survey-form">
            
                  
                        
                        <input class="" type="hidden" name="self_id"
                            value="<?= $projects["self_id"] ?>" />
                   
                <fieldset>
                    <label for="name" id="name-label">
                        Project Name
                        <input class="" type="text" name="p_name" placeholder="p_name "
                            value="<?= $projects["p_name"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="email">
                        Project Description
                        <input class="" type="text" name="p_description"
                            placeholder="p_description " value="<?= $projects["p_description"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="number" id="number-label">
                        Project Requirement
                        <input class="" type="text" name="p_requirement"
                            placeholder="p_requirement" value="<?= $projects["p_requirement"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Software
                        <input class="" type="text" name="p_software"
                            placeholder="p_software" value="<?= $projects["p_software"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Hardware
                        <input class="" type="text" name="p_hardware"
                            placeholder="p_hardware" value="<?= $projects["p_hardware"] ?>" />
                    </label>
                </fieldset>
                
                <fieldset>
                    <label for="name" id="name-label">
                        Project Group Members
                        <input class="" type="text" name="group"
                            placeholder=" " value="<?= $projects["Group_Members"] ?>" />
                    </label>
                </fieldset>
                <!--Gonna put teammates here-->


                <fieldset>
                    <label for="name" id="name-label">
                        Project Media
                        <input class="" type="text" name="p_mediapath"
                            placeholder="p_mediapath " value="<?= $projects["p_mediapath"] ?>" />
                    </label>
                </fieldset>
                <!--<fieldset>
                    <input class="uploadfile" type="file" id="myFile" name="filename" value="
                </fieldset>-->

                <input type="submit" value="Submit the form" class="btn">
                <button id="return" type="return" class="btn"> <a href="inst_stu.php"> Return to table</a></button>
                <!--<div id="display-image">
                    
                        /* $query = " select * from image ";
                         $result = mysqli_query($db, $query);
 
                        while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <img src="./image/ echo $data['filename']; ?>">

                   
                     }*/
                   
                </div>-->
            </form>
            
        </div>
    </div>
</main>
<?php 
}?>



<!--BREAK-->




<body>
<?php
if($userdata["type"]==2){
?>

<main id="main" class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-offset-3 col-lg-6">
            <div class="m-b-md text-center">
                <h1 id="title">Update Project</h1>
                <p id="description" class="description" class="text-center">Update your project information!
                </p>
            </div>
            <form method="post" action="" id="survey-form" name="survey-form">
                <input class="" type="hidden" name="self_id"
                            value="<?= $projects["self_id"] ?>" />
                <fieldset>
                    <label for="name" id="name-label">
                        Project Name
                        <input class="" type="text" name="p_name" placeholder="p_name "
                            value="<?= $projects["p_name"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="email">
                        Project Description
                        <input class="" type="text" name="p_description"
                            placeholder="p_description " value="<?= $projects["p_description"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="number" id="number-label">
                        Project Requirement
                        <input class="" type="text" name="p_requirement"
                            placeholder="p_requirement" value="<?= $projects["p_requirement"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Software
                        <input class="" type="text" name="p_software"
                            placeholder="p_software" value="<?= $projects["p_software"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Hardware
                        <input class="" type="text" name="p_hardware"
                            placeholder="p_hardware" value="<?= $projects["p_hardware"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Year
                        <input type="text" placeholder="year"
                            name="year" value="<?= $projects["year"] ?>" />
                    </label>
                </fieldset>
                

                <fieldset>
                    <label for="name" id="name-label">
                        Project Media
                        <input class="" type="text" name="p_mediapath"
                            placeholder="p_mediapath " value="<?= $projects["p_mediapath"] ?>" />
                    </label>
                </fieldset>
                <input type="hidden" name="state">
                <input type="hidden" name="comment">
                <input type="hidden" name="semester">
                <input type="hidden" name="advisor">
                <input type="hidden" name="group">

                <!--<fieldset>
                    <input class="uploadfile" type="file" id="myFile" name="filename" value="
                </fieldset>-->

                <input type="submit" value="Submit the form" class="btn">
                <button id="return" type="return" class="btn"> <a href="firm.php"> Return to table</a></button>
                <!--<div id="display-image">
                   
                </div>-->
            </form>
            
        </div>
    </div>
</main>
<?php 
}?>

<!--BREAK-->



<?php
if($userdata["type"]==3){
?>

<main id="main" class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-offset-3 col-lg-6">
            <div class="m-b-md text-center">
                <h1 id="title">Update Project</h1>
                <p id="description" class="description" class="text-center">Update your project information!
                </p>
            </div>
            <form method="post" action="" id="survey-form" name="survey-form">
                <input class="" type="hidden" name="self_id"
                            value="<?= $projects["self_id"] ?>" />
                <fieldset>
                    <label for="name" id="name-label">
                        Project Name
                        <input class="" type="text" name="p_name" placeholder="p_name "
                            value="<?= $projects["p_name"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="email">
                        Project Description
                        <input class="" type="text" name="p_description"
                            placeholder="p_description " value="<?= $projects["p_description"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="number" id="number-label">
                        Project Requirement
                        <input class="" type="text" name="p_requirement"
                            placeholder="p_requirement" value="<?= $projects["p_requirement"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Software
                        <input class="" type="text" name="p_software"
                            placeholder="p_software" value="<?= $projects["p_software"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Hardware
                        <input class="" type="text" name="p_hardware"
                            placeholder="p_hardware" value="<?= $projects["p_hardware"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Year
                        <input type="text" placeholder="year"
                            name="year" value="<?= $projects["year"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Semester
                        <input class="" type="text" name="semester"
                            placeholder="semester " value="<?= $projects["semester"] ?>" />
                    </label>
                </fieldset>
                <?php 
                if($userdata["advisor_status"]==1){?>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Comment
                        <input class="" type="text" name="comment"
                            placeholder="comment " value="<?= $projects["comment"] ?>" />
                    </label>
                </fieldset>
                
                <?php
                }?>

                <fieldset>
                    <label for="name" id="name-label">
                        Project Media
                        <input class="" type="text" name="p_mediapath"
                            placeholder="p_mediapath " value="<?= $projects["p_mediapath"] ?>" />
                    </label>
                </fieldset>
                <!--<fieldset>
                    <input class="uploadfile" type="file" id="myFile" name="filename" value="
                </fieldset>-->

                <input type="submit" value="Submit the form" class="btn">
                <button id="return" type="return" class="btn"> <a href="inst_stu.php"> Return to table</a></button>
                <!--<div id="display-image">
                    
                        /* $query = " select * from image ";
                         $result = mysqli_query($db, $query);
 
                        while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <img src="./image/ echo $data['filename']; ?>">

                   
                     }*/
                   
                </div>-->
            </form>
            
        </div>
    </div>
</main>
<?php 
}?>



<!---BREAK-->
<?php
if($userdata["type"]==4){
?>

<main id="main" class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-offset-3 col-lg-6">
            <div class="m-b-md text-center">
                <h1 id="title">Update Project</h1>
                <p id="description" class="description" class="text-center">Update your project information!
                </p>
            </div>
            <form method="post" action="" id="survey-form" name="survey-form">
                    <input class="" type="hidden" name="self_id"
                            value="<?= $projects["self_id"] ?>" />
                   
                <fieldset>
                    <label for="name" id="name-label">
                        Project Name
                        <input class="" type="text" name="p_name" placeholder="p_name "
                            value="<?= $projects["p_name"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="email">
                        Project Description
                        <input class="" type="text" name="p_description"
                            placeholder="p_description " value="<?= $projects["p_description"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="number" id="number-label">
                        Project Requirement
                        <input class="" type="text" name="p_requirement"
                            placeholder="p_requirement" value="<?= $projects["p_requirement"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Software
                        <input class="" type="text" name="p_software"
                            placeholder="p_software" value="<?= $projects["p_software"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Hardware
                        <input class="" type="text" name="p_hardware"
                            placeholder="p_hardware" value="<?= $projects["p_hardware"] ?>" />
                    </label>
                </fieldset>
                
                <fieldset>
                    <label for="name" id="name-label">
                        Project Semester
                        <input class="" type="text" name="semester"
                            placeholder="semester " value="<?= $projects["semester"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Comment
                        <input class="" type="text" name="comment"
                            placeholder="comment " value="<?= $projects["comment"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Advisor
                        <input class="" type="text" name="advisor"
                            placeholder="advisor " value="<?= $projects["advisor"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project State
                        <input class="" type="text" name="state"
                            placeholder="state " value="<?= $projects["state"] ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Media
                        <input class="" type="text" name="p_mediapath"
                            placeholder="p_mediapath " value="<?= $projects["p_mediapath"] ?>" />
                    </label>
                </fieldset>
                <!--<fieldset>
                    <input class="uploadfile" type="file" id="myFile" name="filename" value="
                </fieldset>-->

                
                <input type="submit" value="Submit the form" class="btn">
                <button id="return" type="return" class="btn"> <a href="admin.php"> Return to table</a></button>
                <!--<button id="return" type="return" class="btn" href="index2.php">Return to table</button>
                -->
                <!--<div id="display-image">
                    
                        /* $query = " select * from image ";
                         $result = mysqli_query($db, $query);
 
                        while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <img src="./image/ echo $data['filename']; ?>">

                   
                     }*/
                   
                </div>-->
            </form>
            
        </div>
    </div>
</main>
<?php 
}?>

<body>
</html>