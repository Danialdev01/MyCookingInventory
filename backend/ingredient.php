<?php
    session_start();
    include('../config/connect.php');
    include('./function/system.php');
    include('./function/csrf-token.php');
    include('./function/user.php');

    checkCSRFToken();

    //@ Set Ingredient
    if(isset($_POST['create_ingredient'])){

        if(
            isset($_POST['name_ingredient']) && 
            isset($_POST['min_unit_ingredient']) && 
            isset($_POST['unit_ingredient'])
        ){

            $user_value = decryptUser($_SESSION['MyCookingInventoryUserHash'], $secret_key);
            $id_user = $user_value['id_user'];

            $name_ingredient = validateInput($_POST['name_ingredient']);
            $unit_ingredient = validateInput($_POST['unit_ingredient']);
            $min_unit_ingredient = validateInput($_POST['min_unit_ingredient']);

            $create_ingredient_sql = $connect->prepare("INSERT INTO ingredients(id_ingredient, id_user, name_ingredient, unit_ingredient, min_unit_ingredient, status_ingredient) VALUES (NULL , ? , ? , ? , ? , 1)");
            $create_ingredient_sql->execute([
                $id_user,
                $name_ingredient,
                $unit_ingredient,
                $min_unit_ingredient
            ]);

            log_activity_message("../log/user_activity_log", "Successfully Set New Ingredient");
            alert_message("success", "Successfully Set New Ingredient");
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

    //@ Delete
    elseif(isset($_POST['delete_ingredient'])){

        if(
            isset($_POST['id_ingredient'])
        ){

            $id_ingredient = validateInput($_POST['id_ingredient']);

            $delete_ingredient_sql = $connect->prepare("UPDATE ingredients SET status_ingredient = 2 WHERE id_ingredient = ?");
            $delete_ingredient_sql->execute([
                $id_ingredient
            ]);

            log_activity_message("../log/user_activity_log", "Successfully Delete Ingredient");
            alert_message("success", "Successfully Delete Ingredient");
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

    //@ Edit 
    elseif(isset($_POST['edit_ingredient'])){

        if(
            isset($_POST['id_ingredient']) &&
            isset($_POST['name_ingredient']) && 
            isset($_POST['min_unit_ingredient']) && 
            isset($_POST['unit_ingredient'])
        ){

            $id_ingredient = validateInput($_POST['id_ingredient']);
            $name_ingredient = validateInput($_POST['name_ingredient']);
            $unit_ingredient = validateInput($_POST['unit_ingredient']);
            $min_unit_ingredient = validateInput($_POST['min_unit_ingredient']);

            $edit_ingredient_sql = $connect->prepare("UPDATE ingredients SET name_ingredient = ? , unit_ingredient = ? , min_unit_ingredient = ?  WHERE id_ingredient = ?");
            $edit_ingredient_sql->execute([
                $name_ingredient,
                $unit_ingredient,
                $min_unit_ingredient,
                $id_ingredient
            ]);

            log_activity_message("../log/user_activity_log", "Successfully Edit Ingredient");
            alert_message("success", "Successfully Delete Ingredient");
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