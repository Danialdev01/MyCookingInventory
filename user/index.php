<?php $title = "User";$location_index = ".."; include('../components/head.php');?>

<body class="light">
    <main>
        <?php $location_index = ".."; include('../components/user/nav.php');?>

        <?php $location_index = ".."; include('../components/user/new-stock.php')?>

        <center>
            <h1 class="text-lg font-bold text-black pt-5">All Stock Overview</h1>
            <div class="max-w-7xl">

                <table id="stock-active" class="display">
                    <thead>
                        <tr>
                            <td>Name Ingredient</td>
                            <td>Cost Of Stock</td>
                            <td>Number Of Stock</td>
                            <td>Expired Date Stock</td>
                            <td>Manage</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php 
                        $user_value = decryptUser($_SESSION['MyCookingInventoryUserHash'], $secret_key);
                        $id_user = $user_value['id_user'];
    
                        $stock_active_sql = $connect->prepare("SELECT * FROM stocks WHERE id_user = ? AND status_stock = 1");
                        $stock_active_sql->execute([$id_user]);
    
                        while($stock_active = $stock_active_sql->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <tr>
                                <?php
                                    $ingredient_stock_active_sql = $connect->prepare("SELECT * FROM ingredients WHERE id_ingredient = ?");
                                    $ingredient_stock_active_sql->execute([$stock_active['id_ingredient']]);
                                    $ingredient_stock_active = $ingredient_stock_active_sql->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <td>
                                    <?php echo htmlspecialchars($ingredient_stock_active['name_ingredient'])?>
                                </td>

                                <?php $value_stock = $stock_active['val_stock'] * $stock_active['cost_stock']?>
                                <td>RM <?php echo htmlspecialchars($value_stock) ?></td>
                                <td><?php echo htmlspecialchars($stock_active['val_stock']) . " " . $ingredient_stock_active['unit_ingredient']?></td>
                                <td><?php echo htmlspecialchars($stock_active['exp_date_stock'])?></td>
                                <td>
                                    <div style="text-align: center;">
                                        <button data-modal-target="manage-stock-modal_<?php echo $stock_active['id_stock'] ?>" data-modal-toggle="manage-stock-modal_<?php echo $stock_active['id_stock'] ?>" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark-bg-blue-600 dark-hover:bg-blue-700 dark-focus:ring-blue-800" type="button">
                                            Manage Stock
                                        </button> 
                                    </div>
                                </td>
                            </tr>   
                            <?php include('../components/user/manage-stock.php')?>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>

                <div class="pt-5" style="text-align: center;">
                    <button data-modal-target="new-stock-modal" data-modal-toggle="new-stock-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark-bg-blue-600 dark-hover:bg-blue-700 dark-focus:ring-blue-800" type="button">
                        Add New Stock
                    </button> 
                </div>
            </div>
            
        </center>



    </main>

    <script>
        new DataTable('#stock-active');
    </script>

    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../src/assets/js/tw-elements.umd.min.js"></script>
    <script src="../src/assets/js/validateInput.js"></script>
    <?php $location_index = ".."; include('../components/footer.php')?>
</body>
</html>