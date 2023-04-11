<?php
//Emre Cura 
//Bertan Özer
session_start();
require "user.php";
$local=" ";
if ( $_SERVER["REQUEST_METHOD"] === "POST") 
    {
        extract($_POST);
        $error=[];
        
        if(isset($_POST["submit"]))
        {
            if(strlen(trim($_POST["name"]))===0)
            {
                $error["name"]="Name is empty";
           
            }
            if(strlen(trim($_POST["email"]))===0)
            {
            
                $error["email"]="Email is empty";
            
            
           
            }
            if(strlen(trim($_POST["user"]))===0)
            {
                $error["user"]="Username is empty";
           
            }
            if(strlen(trim($_POST["password"]))===0)
            {
                $error["password"]="Please enter a password";
           
            }
            if(strlen(trim($_POST["confirm"]))===0)
            {
                $error["confirm"]="Reenter the password";
           
            }
            if(strlen(trim($_POST["id"]))===0)
            {
                $error["id"]="ID is empty";
           
            }
            if(filter_var($id, FILTER_VALIDATE_INT)===false)
            {
                $error["notNum"]="That's not an integer!";
            }
            
            if(strlen(trim($_POST["id"]))===0 && filter_var($id, FILTER_VALIDATE_INT)===false)
            {
                $error["notNum"]="";
            }
            
            if ( checkInstUser($_POST["email"], $_POST["name"], $_POST["user"], $_POST["password"], $id) ) 
            {
                    // you are authenticated
                    // session_start() creates a random id called session id.
                    // and stores in a cookie.
          
                    $_SESSION["user"] = getInstUser($id) ;
                    header("Location: redirect.php") ;
                    exit ;
            }
            
            if ( checkStuUser($_POST["email"], $_POST["name"], $_POST["user"], $_POST["password"], $id) ) 
            {
                    // you are authenticated
                    // session_start() creates a random id called session id.
                    // and stores in a cookie.
          
                    $_SESSION["user"] = getStuUser($id) ;
                    header("Location: redirect.php") ;
                    exit ;
            }

            if ( checkAdmin($_POST["email"], $_POST["name"], $_POST["user"], $_POST["password"], $id) ) 
            {
                    // you are authenticated
                    // session_start() creates a random id called session id.
                    // and stores in a cookie.
          
                    $_SESSION["user"] = getAdmin($id) ;
                    header("Location: redirect.php") ;
                    exit ;
            }
          
            // auto login (homework)
            if ( validSession()) {
                header("Location: redirect.php") ;
                exit ;
            }
                

        }

        else if(isset($_POST["submit2"]))
        {
            if(strlen(trim($_POST["email2"]))===0)
            {
            
                $error["email2"]="Email is empty";
            
            
           
            }
            if(strlen(trim($_POST["user2"]))===0)
            {
                $error["user2"]="Username is empty";
           
            }
       

            if(strlen(trim($_POST["password2"]))===0)
            {
                $error["password2"]="Please enter a password";
           
            }
       
            if(strlen(trim($_POST["confirm2"]))===0)
            {
                $error["confirm2"]="Reenter the password";
           
            }
       
            if(strlen(trim($_POST["firm"]))===0)
            {
                $error["firm"]="Firm Name is empty";
           
            }
        
            if(strlen(trim($_POST["id2"]))===0)
            {
                $error["id2"]="ID is empty";
           
            }
            if(filter_var($id2, FILTER_VALIDATE_INT)===false)
            {
                $error["notNum"]="That's not an integer!";
            }
            
            if(strlen(trim($_POST["id2"]))===0 && filter_var($id2, FILTER_VALIDATE_INT)===false)
            {
                $error["notNum"]="";
            }
            if ( checkFirmUser($_POST["email2"], $_POST["firm"], $_POST["user2"], $_POST["password2"], $id2) ) 
                {
                    // you are authenticated
                    // session_start() creates a random id called session id.
                    // and stores in a cookie.
          
                    $_SESSION["user"] = getFirmUser($id2) ;
                    header("Location: redirect.php") ;
                    exit ;
                }
                echo "<p>Wrong email or password</p>" ;
            
          
            // auto login (homework)
            if ( validSession()) {
                header("Location: redirect.php") ;
                exit ;
            }
        }

        
    }
    
                                              
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pro.css">
    <script src="pro.js"></script>
    <title>Document</title>
    <style>
    p.error_msg {
        text-align: center;
        color: red;
        font-style: italic;
    }

    .label {
        float: left;
        justify-content: space-between;


    }

    .label input {
        margin-left: 20px;
        margin-top: 7px;
    }
    </style>
</head>

<body>
    <div id="header-wrapper">
        <div id="header">
            <h1>Sustainability Project</h1>
            <div id="menu">
                <ul>
                    <a href="login.php">
                        <li>Login</li>
                    </a>
                    <a href="register copy.php">
                        <li>Register</li>
                    </a>
                    <a href="guestproject.php">
                        <li>List Projects</li>
                    </a>
                </ul>
            </div>
        </div>
    </div>

    <div class="cotn_principal">
        <div class="cont_centrar">

            <div class="cont_login">
                <div class="cont_info_log_sign_up">
                    <div class="col_md_login">
                        <div class="cont_ba_opcitiy">

                            <h2>Firm User</h2>
                            <p>Login your Firm User account.</p>
                            <button class="btn_login" onclick="cambiar_login()">Login</button>
                        </div>
                    </div>
                    <div class="col_md_sign_up">
                        <div class="cont_ba_opcitiy">
                            <h2>Instructor User / Student User / Admin User</h2>


                            <p>Login your Instructor User or Student or Admin account.</p>

                            <button class="btn_sign_up" onclick="cambiar_sign_up()">Login</button>
                        </div>
                    </div>
                </div>


                <div class="cont_back_info">
                    <div class="cont_img_back_grey">
                        <img src="https://images.unsplash.com/42/U7Fc1sy5SCUDIu4tlJY3_NY_by_PhilippHenzler_philmotion.de.jpg?ixlib=rb-0.3.5&q=50&fm=jpg&crop=entropy&s=7686972873678f32efaf2cd79671673d"
                            alt="" />
                    </div>

                </div>
                <div class="cont_forms">
                    <div class="cont_img_back_">
                        <img src="https://images.unsplash.com/42/U7Fc1sy5SCUDIu4tlJY3_NY_by_PhilippHenzler_philmotion.de.jpg?ixlib=rb-0.3.5&q=50&fm=jpg&crop=entropy&s=7686972873678f32efaf2cd79671673d"
                            alt="" />
                    </div>

                    <form action="" method="post">
                        <div class="cont_form_login">

                            <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
                            <h2>Firm User</h2>

                            <input type="text" placeholder="Email" name="email2"
                                value="<?=isset($email2) ? filter_var($email2, FILTER_SANITIZE_FULL_SPECIAL_CHARS ) : "" ?>" />
                            <?php
                                if(isset($error["email2"]))
                                {
                                    echo "<p class='error_msg '>{$error["email2"]}</p>";
                                }
                                else
                                {
                                    echo "";
                                }
                                
                                
                            ?>
                            <input type="text" placeholder="Firm Name" name="firm"
                                value="<?=isset($firm) ? filter_var($firm, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ?>" />
                            <?php
                                if(isset($error["firm"]))
                                {
                                    echo "<p class='error_msg '>{$error["firm"]}</p>";
                                }
                                else
                                {
                                    echo "";
                                }
                                
                                
                            ?>
                            <input type="text" placeholder="Username" name="user2"
                                value="<?=isset($user2) ? filter_var($user2, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ?>" />
                            <?php
                                if(isset($error["user2"]))
                                {
                                    echo "<p class='error_msg '>{$error["user2"]}</p>";
                                }
                                else
                                {
                                    echo "";
                                }
                                
                                
                            ?>
                            <input type="password" placeholder="Password" name="password2" />
                            <?php
                                if(isset($error["password2"]))
                                {
                                    echo "<p class='error_msg '>{$error["password2"]}</p>";
                                }
                                else
                                {
                                    echo "";
                                }
                                
                                
                            ?>
                            <input type="password" placeholder="Confirm Password" name="confirm2" />
                            <?php
                                if(isset($error["confirm2"]))
                                {
                                    echo "<p class='error_msg '>{$error["confirm2"]}</p>";
                                }
                                else
                                {
                                    echo "";
                                }
                                
                                
                            ?>

                            <input type="text" placeholder="User ID" name="id2"
                                value="<?=isset($id) ? filter_var($id, FILTER_VALIDATE_INT) : "" ?>" />
                            <?php
                                if(isset($error["id2"]))
                                {
                                    echo "<p class='error_msg '>{$error["id2"]}</p>";
                                }
                                else
                                {
                                    echo "";
                                }
                                if(isset($error["notNum"]))
                                {
                                    echo "<p class='error_msg '>{$error["notNum"]}</p>";
                                }
                                else
                                {
                                    echo "";
                                }
                                
                            ?>

                            <button class="btn_login" type="submit" name="submit2">Login</button>




                        </div>

                    </form>
                    <form action="" method="post">
                        <div class="cont_form_sign_up">
                            <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
                            <h2>Instructor User/Project Advisor User/Student User/Admin User</h2>

                            <input type="text" placeholder="Email" name="email"
                                value="<?=isset($email) ? filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ?>" />
                            <?php
                                if(isset($error["email"]))
                                {
                                    echo "<p class='error_msg '>{$error["email"]}</p>";
                                }
                                
                                
                                
                            ?>
                            <input type="text" placeholder="name" name="name"
                                value="<?=isset($name) ? filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ?>" />
                            <?php
                                if(isset($error["name"]))
                                {
                                    echo "<p class='error_msg '>{$error["name"]}</p>";
                                }
                                
                                
                                
                            ?>
                            <input type="text" placeholder="Username" name="user"
                                value="<?=isset($user) ? filter_var($user, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ?>" />
                            <?php
                                if(isset($error["user"]))
                                {
                                    echo "<p class='error_msg '>{$error["user"]}</p>";
                                }
                                
                                
                                
                            ?>
                            <input type="password" placeholder="Password" name="password" />
                            <?php
                                if(isset($error["password"]))
                                {
                                    echo "<p class='error_msg '>{$error["password"]}</p>";
                                }
                                
                                
                                
                            ?>
                            <input type="password" placeholder="Confirm Password" name="confirm" />
                            <?php
                                if(isset($error["confirm"]))
                                {
                                    echo "<p class='error_msg '>{$error["confirm"]}</p>";
                                }
                                
                                
                                
                            ?>
                            <input type="text" placeholder="id" name="id"
                                value="<?=isset($id) ? filter_var($id, FILTER_VALIDATE_INT) : "" ?>" />
                            <?php
                                if(isset($error["id"]))
                                {
                                    echo "<p class='error_msg '>{$error["id"]}</p>";
                                }
                                else
                                {
                                    echo "";
                                }
                                if(isset($error["notNum"]))
                                {
                                    echo "<p class='error_msg '>{$error["notNum"]}</p>";
                                }
                                else
                                {
                                    echo "";
                                }
                                
                            ?>
                            <br>
                            <br>

                            <button class="btn_sign_up" type="submit" name="submit">Login</button>



                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>