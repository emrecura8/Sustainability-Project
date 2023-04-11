<?php
require "db.php";
    try {
        $stmt = $db->prepare("select * from stu_user");
        $stmt->execute();
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
     } catch( PDOException $ex) {
         gotoErrorPage();
     }
     if(!empty($_POST))
     {
        extract($_POST);
        foreach($students as $stu)
        if(preg_match("/$name/", $stu["name"]) && $id==$stu["id"])
        {
            $stmt2=$db->prepare("update inst_user set advisor_status=?, student_advised=? where id=?");
            $stmt2->execute([1, $stu["name"], $_GET["instId"]]);
            header("Location:admin.php");
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
<body>
<main id="main" class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-offset-3 col-lg-6">
            <div class="m-b-md text-center">
                <h1 id="title">Assign a Student </h1>
                <p id="description" class="description" class="text-center">
                </p>
            </div>
            <form method="post" action="" id="survey-form" name="survey-form">
                
                <fieldset>
                    <label for="name" id="name-label">
                        Enter Student Name
                        <input class="" type="text" name="name"
                            placeholder="p_hardware"  />
                    </label>
                </fieldset>
                <fieldset>
                    <label for="name" id="name-label">
                        Enter Student ID
                        <input class="" type="text" name="id"
                            placeholder="p_hardware"  />
                    </label>
                </fieldset>

                <input type="submit" value="Enter" class="btn">
                <button id="return" type="return" class="btn"> <a href="inst_stu.php"> Return to table</a></button>
                
            </form>
            
        </div>
    </div>
</main>
</body>
</html>