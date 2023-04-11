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
   $userdate=$_SESSION["user"];
   $pid=$userdate["id"];
   if ( isset($_POST['submit'])){
        
        extract($_POST);
   

        $sql = "INSERT INTO project (p_name, p_description, p_requirement, p_software, p_hardware, year, p_mediapath, p_id) VALUES (?,?,?,?,?,?,?,?)";
         $stmt = $db->prepare($sql);
        $year=date("Y");
     
     
        $stmt->execute([$p_name, $p_description, $p_requirement, $p_software, $p_hardware, $year, $p_mediapath, $pid]);
        header("Location:inst_stu.php");
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

</html>
<main id="main" class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-offset-3 col-lg-6">
            <div class="m-b-md text-center">
                <h1 id="title">Add Project</h1>
                <p id="description" class="description" class="text-center">Add your project information!
                </p>
            </div>
            <form method="post" action="" id="survey-form" name="survey-form">
                
                
                <fieldset>
                    <label for="name" id="name-label">
                        Project Name
                        <input class="" type="text" name="p_name" placeholder="p_name "
                             />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="email">
                        Project Description
                        <input class="" type="text" name="p_description"
                            placeholder="p_description" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="number" id="number-label">
                        Project Requirement
                        <input class="" type="text" name="p_requirement"
                            placeholder="p_requirement" value="<?= isset($p_requirement) ? filter_var($p_requirement, FILTER_SANITIZE_FULL_SPECIAL_CHARS ) : "" ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Software
                        <input class="" type="text" name="p_software"
                            placeholder="p_software" value="<?= isset($p_software) ? filter_var($p_software, FILTER_SANITIZE_FULL_SPECIAL_CHARS ) : "" ?>" />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Project Hardware
                        <input class="" type="text" name="p_hardware"
                            placeholder="p_hardware" value="<?= isset($p_hardware) ? filter_var($p_hardware, FILTER_SANITIZE_FULL_SPECIAL_CHARS ) : "" ?>" />
                    </label>
                </fieldset>
                
                
                
                
                <fieldset>
                    <label for="name" id="name-label">
                        Project Media
                        <input class="" type="text" name="p_mediapath"
                            placeholder="p_mediapath " value="<?= isset($p_mediapath) ? filter_var($p_mediapath, FILTER_SANITIZE_FULL_SPECIAL_CHARS ) : "" ?>" />
                    </label>
                </fieldset>
                <!--<fieldset>
                    <input class="uploadfile" type="file" id="myFile" name="filename" value="
                </fieldset>-->
                
                
                <input type="submit" value="Submit the form" name="submit" class="btn">
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