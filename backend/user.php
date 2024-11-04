<?php
    session_start();
    include('../config/connect.php');
    include('./function/system.php');
    include('./function/csrf-token.php');
    include('./function/user.php');

    checkCSRFToken();

    //@ Sign Up
    if(isset($_POST['signup'])){

        if(
            isset($_POST['name_user']) &&
            isset($_POST['email_user']) &&
            isset($_POST['password_user']) &&
            isset($_POST['password_confirm_user'])
        ){

            $createUser = createUser(
                $_POST['name_user'], 
                $_POST['email_user'], 
                $_POST['password_user'], 
                $_POST['password_confirm_user'], 
                $connect
            );

            if($createUser == "SUCCESS"){

                $id_user = $connect->lastInsertId();
                setUser($id_user, validateInput($_POST['password_user']), $secret_key);

                header("Location:../user/");
                log_activity_message("../log/user_activity_log", "User Successfully Sign Up");
                alert_message("success", "Successfully Sign Up");
                exit;
            }
            else{

                log_activity_message("../log/user_activity_log", $createUser);
                alert_message("error", $createUser);
                header("Location:../");
            }

        }
        else{

            log_activity_message("../log/user_activity_log", "Data Not Complete");
            alert_message("error", "Data Not Complete");
            header("Location:../");
            exit;
        }
    }

    //@ Sign In
    elseif(isset($_POST['signin'])){

        if(
            isset($_POST['email_user']) &&
            isset($_POST['password_user'])
        ){

            
            $email_user = validateInput($_POST['email_user']);
            $password_user = validateInput($_POST['password_user']);
            
            $signin_user_sql = $connect->prepare("SELECT * FROM users WHERE email_user = ?");
            $signin_user_sql->execute([$email_user]);
            $signin_user = $signin_user_sql->fetch(PDO::FETCH_ASSOC);
            
            if(!($signin_user['email_user'] == $email_user)){
                
                log_activity_message("../log/user_activity_log", "User Not Found");
                alert_message("error", "User / Password Incorrect");
                header("Location:../");
                exit;                
            }
            
            if(!(password_verify($password_user, $signin_user['password_user']))){
                
                log_activity_message("../log/user_activity_log", "Password Wrong");
                alert_message("error", "User / Password Incorrect");
                header("Location:../");
                exit;                
            }

            $id_user = $signin_user['id_user'];

            setUser($id_user, $password_user, $secret_key);
            header("Location:../user");
            
        }
        else{

            log_activity_message("../log/user_activity_log", "Data Not Complete");
            alert_message("error", "Data Not Complete");
            header("Location:../");
            exit;    
        }
    }

    //@ Log Out
    elseif(isset($_POST['signout'])){

        session_destroy();
        setcookie('MyCookingInventoryUserHash', 2, time() - 3600 , "/");
        header("location:../");
        // exit();

    }
?>