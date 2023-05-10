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
   $pid=$userdata["id"];
   $utype=$userdata["type"];
   if ( isset($_POST['submit']))
   {
        extract($_POST);
        switch($utype)
        {
            case 3: 
                $stmt=$db->prepare("update inst_user set email=?, name=?, username = ?, password=? where id=?");
                $stmt->execute([$email, $name, $username, $password, $userdata["id"]]);
                $_SESSION["user"]=getInstUser($userdata["id"]);
                header("Location:viewinfoinst_stu.php");
                
                break;
            case 1:
                $stmt=$db->prepare("update stu_user set email=?, name=?, username = ?, password=? where id=?");
                $stmt->execute([$email, $name, $username, $password,  $userdata["id"]]);
                $_SESSION["user"]=getStuUser($userdata["id"]);
                header("Location:viewinfoinst_stu.php");
                break;
            case 4:
                $stmt=$db->prepare("update admin set email=?, name=?, username = ?, password=? where id=?");
                $stmt->execute([$email, $name, $username, $password,  $userdata["id"]]);
                $_SESSION["user"]=getAdmin($userdata["id"]);
                header("Location:viewinfoadmin.php");
                break;
            case 2:
                $stmt=$db->prepare("update firm_user set email=?, firm_name=?, firm_username = ?, firm_password=?, city=?, district=?, address=? where id=?");
                $stmt->execute([$email, $name, $username, $password, $city, $district, $address,  $userdata["id"]]);
                $_SESSION["user"]=getFirmUser($userdata["id"]);
                header("Location:viewinfofirm.php");
                break;

        }

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
                <h1 id="title">Update User Information</h1>
                <p id="description" class="description" class="text-center">y
                </p>
            </div>
            <?php
                if($utype==2)
                {
            ?>

            <form method="post" action="" id="survey-form" name="survey-form">
                <fieldset>
                    <label for="name" id="name-label">
                        Email
                        <input class="" type="text" name="email" placeholder="Email"
                        value="<?= isset($userdata["email"]) ? filter_var($userdata["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>"/>
                    </label>
                </fieldset>
                
                <fieldset>
                    <label for="name" id="name-label">
                        Firm Name
                        <input class="" type="text" name="name" placeholder="Name and surname"
                        value="<?= isset($userdata["firm_name"]) ? filter_var($userdata["firm_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>"/>
                    </label>
                </fieldset>
                <fieldset>
                    <label for="email">
                        Username
                        <input class="" type="text" name="username"
                            placeholder="Username" value="<?= isset($userdata["firm_username"]) ? filter_var($userdata["firm_username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>"/>
                    </label>
                </fieldset>
                <fieldset>
                    <label for="number" id="number-label">
                        Password
                        <input class="" type="text" name="password"
                            placeholder="p_requirement" value="<?= isset($userdata["firm_password"]) ? filter_var($userdata["firm_password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>"/>
                    </label>
                </fieldset>

                <fieldset>
                    <label for="number" id="number-label">
                        City
                        <input class="" type="text" name="city"
                            placeholder="p_requirement" value="<?= isset($userdata["city"]) ? filter_var($userdata["city"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>" />
                    </label>
                </fieldset>

                <fieldset>
                    <label for="number" id="number-label">
                        District
                        <input class="" type="text" name="district"
                            placeholder="p_requirement" value="<?= isset($userdata["district"]) ? filter_var($userdata["district"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>" />
                    </label>
                </fieldset>

                <fieldset>
                    <label for="number" id="number-label">
                        Address
                        <input class="" type="text" name="address"
                            placeholder="p_requirement" value="<?= isset($userdata["address"]) ? filter_var($userdata["address"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>" />
                    </label>
                </fieldset>
                
                <input type="submit" value="Change Info" name="submit" class="btn">
                <button id="return" type="return" class="btn"> <a href="viewinfofirm.php"> Return to table</a></button>

            </form>



            <?php
                }

                else if($utype==4)
                {
            ?>
            <form method="post" action="" id="survey-form" name="survey-form">
                <fieldset>
                    <label for="name" id="name-label">
                        Email
                        <input class="" type="text" name="email" placeholder="Email"
                        value="<?= isset($userdata["email"]) ? filter_var($userdata["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>" />
                    </label>
                </fieldset>
                
                <fieldset>
                    <label for="name" id="name-label">
                        Name and Surname
                        <input class="" type="text" name="name" placeholder="Name and surname"
                        value="<?= isset($userdata["name"]) ? filter_var($userdata["name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>"/>
                    </label>
                </fieldset>
                <fieldset>
                    <label for="email">
                        Username
                        <input class="" type="text" name="username"
                            placeholder="Username" 
                            value="<?= isset($userdata["username"]) ? filter_var($userdata["username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>"/>
                    </label>
                </fieldset>
                <fieldset>
                    <label for="number" id="number-label">
                        Password
                        <input class="" type="text" name="password"
                            placeholder="p_requirement" value="<?= isset($userdata["password"]) ? filter_var($userdata["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>" />
                    </label>
                </fieldset>
                
                <input type="submit" value="Change Info" name="submit" class="btn">
                <button id="return" type="return" class="btn"> <a href="viewinfoadmin.php"> Return to table</a></button>
                <!--<div id="display-image">
                    
                        /* $query = " select * from image ";
                         $result = mysqli_query($db, $query);
 
                        while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <img src="./image/ echo $data['filename']; ?>">

                   
                     }*/
                   
                </div>-->
            </form>
            






            <?php
                }
                else 
                {
            ?>
            <form method="post" action="" id="survey-form" name="survey-form">
                <fieldset>
                    <label for="name" id="name-label">
                        Email
                        <input class="" type="text" name="email" placeholder="Email"
                        value="<?= isset($userdata["email"]) ? filter_var($userdata["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>" />
                    </label>
                </fieldset>
                
                <fieldset>
                    <label for="name" id="name-label">
                        Name and Surname
                        <input class="" type="text" name="name" placeholder="Name and surname"
                        value="<?= isset($userdata["name"]) ? filter_var($userdata["name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>"/>
                    </label>
                </fieldset>
                <fieldset>
                    <label for="email">
                        Username
                        <input class="" type="text" name="username"
                            placeholder="Username" 
                            value="<?= isset($userdata["username"]) ? filter_var($userdata["username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>"/>
                    </label>
                </fieldset>
                <fieldset>
                    <label for="number" id="number-label">
                        Password
                        <input class="" type="text" name="password"
                            placeholder="p_requirement" value="<?= isset($userdata["password"]) ? filter_var($userdata["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS ) :"" ?>" />
                    </label>
                </fieldset>
                
                <input type="submit" value="Change Info" name="submit" class="btn">
                <button id="return" type="return" class="btn"> <a href="viewinfoinst_stu.php"> Return to table</a></button>
                <!--<div id="display-image">
                    
                        /* $query = " select * from image ";
                         $result = mysqli_query($db, $query);
 
                        while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <img src="./image/ echo $data['filename']; ?>">

                   
                     }*/
                   
                </div>-->
            </form>
            <?php
                }
            ?>
        </div>
    </div>
</main>