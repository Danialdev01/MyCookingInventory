<?php

session_start();
include('../../config/connect.php');
include('../../backend/function/system.php');
include('../../backend/function/user.php');

use Dompdf\Dompdf;
use Dompdf\Options;


    require __DIR__ . "../../../vendor/autoload.php";

    $options = new Options();
    $options->setChroot(__DIR__);

    $dompdf = new Dompdf($options);
    $dompdf->setPaper("A4", "Portrate");

    $html = file_get_contents("borang.html");
    
    $user_value = decryptUser($_SESSION['MyCookingInventoryUserHash'], $secret_key);
    $id_user = $user_value['id_user'];
    $ingredient_active_sql = $connect->prepare("SELECT * FROM ingredients WHERE id_user = ? AND status_ingredient = 1");
    $ingredient_active_sql->execute([$id_user]);

    $item_list_str ="";
    $i = 0;

    while($ingredient_active = $ingredient_active_sql->fetch(PDO::FETCH_ASSOC)){

        $ingredient_active_item_sql = $connect->prepare("SELECT * FROM stocks WHERE id_ingredient = ?");
        $ingredient_active_item_sql->execute([$ingredient_active['id_ingredient']]);

        $name_ingredient = $ingredient_active['name_ingredient'];
    
        $stock_left = 0;
        while($ingredient_active_item = $ingredient_active_item_sql->fetch(PDO::FETCH_ASSOC)){
            $stock_left = $stock_left + $ingredient_active_item['val_stock'];
        }

        if($stock_left < $ingredient_active['min_unit_ingredient']){

            $purchase = $ingredient_active['min_unit_ingredient'] - $stock_left;
            $i++;

            $item_list_str .= "<tr><td>$i</td><td>$name_ingredient</td><td>$purchase</td></tr>";       
        }
    }

    $html = str_replace("{{  bahan  }}", $item_list_str, $html);



    
    $dompdf->loadHtml($html);
    $dompdf->render();

    $dompdf->stream("borang.pdf", ["Attachment" => 0]);


?>