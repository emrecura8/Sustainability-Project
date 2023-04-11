<?php
    require "db.php";
    function checkFirmUser($email2, $firm, $user2, $password2,  $id2) 
    {
        global $db ;
   
        $stmt = $db->prepare("select * from firm_user where firm_name=? AND firm_username=? AND firm_password=? AND id=?") ;
        $stmt->execute([$firm, $user2, $password2, $id2]) ;
        if ( $stmt->rowCount()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
            if($id2==$user["id"])
            {
                return true;
            }
        }
        return false ;
    }
    function validSession() {
        return isset($_SESSION["user"]) ;
    }
   
   
    function getFirmUser($id2) {
        global $db ;
        $stmt = $db->prepare("select * from firm_user where id=?") ;
        $stmt->execute([$id2]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ;
    }
   
    function checkInstUser($email, $name, $username, $password, $id) {
        global $db ;
   
        $stmt = $db->prepare("select * from inst_user where email=? AND name=? AND username=? AND password=? AND id=?") ;
        $stmt->execute([$email, $name, $username, $password, $id]) ;
        if ( $stmt->rowCount()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
            if($id==$user["id"])
            {
                return true;
            }
        }
        return false ;
    }
    function getInstUser($id) {
        global $db ;
        $stmt = $db->prepare("select * from inst_user where id=?") ;
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ;
    }



    function checkStuUser($email, $name, $username, $password, $id) {
        global $db ;
   
        $stmt = $db->prepare("select * from stu_user where email=? AND name=? AND username=? AND password=? AND id=?") ;
        $stmt->execute([$email, $name, $username, $password, $id]) ;
        if ( $stmt->rowCount()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
            if($id==$user["id"])
            {
                return true;
            }
        }
        return false ;
    }
    function getStuUser($id) {
        global $db ;
        $stmt = $db->prepare("select * from stu_user where id=?") ;
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ;
    }


    
    function checkAdmin($email, $name, $username, $password, $id) {
        global $db ;
   
        $stmt = $db->prepare("select * from admin where email=? AND name=? AND username=? AND password=? AND id=?") ;
        $stmt->execute([$email, $name, $username, $password, $id]) ;
        if ( $stmt->rowCount()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
            if($id==$user["id"])
            {
                return true;
            }
        }
        return false ;
    }
    function getAdmin($id) {
        global $db ;
        $stmt = $db->prepare("select * from admin where id=?") ;
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ;
    }




    //////////
    //
    function getProject($p_id) {
        global $db ;
        try {
           $stmt = $db->prepare("SELECT * FROM project WHERE p_id = ?") ;
           $stmt->execute([$p_id]) ;
           return $stmt->fetch(PDO::FETCH_ASSOC) ;
        } catch( PDOException $ex) {
          gotoErrorPage() ;
        }
    }
    
    function gotoErrorPage() {
        header("Location: error.php") ;
        exit ;
      }
    
    function gotoErrorPage2() {
        header("Location: error2.php") ;
        exit ;
      }
    
    
    function gotoErrorPage3() {
        header("Location: error3.php") ;
        exit ;
      }





?>