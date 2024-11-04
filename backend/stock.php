<?php
    session_start();
    include('../config/connect.php');
    include('./function/system.php');
    include('./function/csrf-token.php');
    include('./function/user.php');

    checkCSRFToken();

    //@ Create Stock
    if(isset($_POST['create_stock'])){

        if(
            isset($_POST['id_ingredient']) && 
            isset($_POST['cost_stock']) && 
            isset($_POST['val_stock']) && 
            isset($_POST['exp_date_stock']) 
        ){

            $user_value = decryptUser($_SESSION['MyCookingInventoryUserHash'], $secret_key);

            $id_user = $user_value['id_user'];
            $id_ingredient = validateInput($_POST['id_ingredient']);
            $cost_stock = validateInput($_POST['cost_stock']);
            $val_stock = validateInput($_POST['val_stock']);
            $exp_date_stock = validateInput($_POST['exp_date_stock']);
            $created_date_stock = date("Y-m-d");

            $create_stock_sql = $connect->prepare("INSERT INTO stocks(id_stock, id_user, id_ingredient, cost_stock, val_stock, exp_date_stock, created_date_stock, status_stock) VALUES (NULL, ? , ? , ? , ? , ? , ? , 1)");
            $create_stock_sql->execute([
                $id_user,
                $id_ingredient,
                $cost_stock,
                $val_stock,
                $exp_date_stock,
                $created_date_stock
            ]);

            $cost_stock_value = $cost_stock * $val_stock; 
            $add_report_value_sql = $connect->prepare("INSERT INTO report_values(id_report_value, id_ingredient, id_report_analytic, cost_ingredient, status_ingredient) VALUES (NULL, ? , NULL , ? , 1)");
            $add_report_value_sql->execute([
                $id_ingredient,
                $cost_stock_value
            ]); 

            log_activity_message("../log/user_activity_log", "Successfully Set New Stock");
            alert_message("success", "Successfully Set New Stock");
            header("Location: " . $_SERVER["HTTP_REFERER"]);   
            exit;
        }
        else{

            log_activity_message("../log/user_activity_log", "Data Not Complete");
            alert_message("error", "Data Not Complete");
            header("Location:../");
            exit; 
        }
    }

    //@ Save Stock
    elseif(isset($_POST['save_stock'])){

        if(
            isset($_POST['id_stock']) && 
            isset($_POST['cost_stock']) && 
            isset($_POST['val_stock']) && 
            isset($_POST['exp_date_stock'])
        ){

            $id_stock = validateInput($_POST['id_stock']);
            $cost_stock = validateInput($_POST['cost_stock']);
            $val_stock = validateInput($_POST['val_stock']);
            $exp_date_stock = validateInput($_POST['exp_date_stock']);

            $save_stock_sql = $connect->prepare("UPDATE stocks SET cost_stock = ? , val_stock = ? , exp_date_stock = ? WHERE id_stock = ?");
            $save_stock_sql->execute([
                $cost_stock,
                $val_stock,
                $exp_date_stock,
                $id_stock
            ]);

            log_activity_message("../log/user_activity_log", "Successfully Save Stock");
            alert_message("success", "Successfully Save Stock");
            header("Location: " . $_SERVER["HTTP_REFERER"]);   
            exit;

        }
        else{

            log_activity_message("../log/user_activity_log", "Data Not Complete");
            alert_message("error", "Data Not Complete");
            header("Location:../");
            exit; 
        }
    }

    //@ Clear Stock
    elseif(isset($_POST['clear_stock'])){

        if(
            isset($_POST['id_stock'])
        ){

            $id_stock = validateInput($_POST['id_stock']);

            $clear_stock_sql = $connect->prepare("UPDATE stocks SET status_stock = 2, val_stock = 0 WHERE id_stock = ?");
            $clear_stock_sql->execute([$id_stock]);

            log_activity_message("../log/user_activity_log", "Successfully Clear Stock");
            alert_message("success", "Successfully Clear Stock");
            header("Location: " . $_SERVER["HTTP_REFERER"]);   
            exit;
        }
        else{

            log_activity_message("../log/user_activity_log", "Data Not Complete");
            alert_message("error", "Data Not Complete");
            header("Location:../");
            exit; 
        }
    }
    

?>