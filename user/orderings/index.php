<?php $title = "Ordering";$location_index = "../.."; include('../../components/head.php');?>

<body>
    <main>
        <?php $location_index = "../.."; include('../../components/user/nav.php');?>

        <center>

            <?php $location_index = "../.."; include('../../components/user/new-ingredient.php');?>

            <div class="max-w-7xl pt-10">
    
                <table id="ingredients-active" class="display" style="width: 100%;">
    
                    <thead>
                        <tr>
                            <th>Name Ingredient</th>
                            <th>Stock Left</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            $user_value = decryptUser($_SESSION['MyCookingInventoryUserHash'], $secret_key);
                            $id_user = $user_value['id_user'];

                            $ingredient_active_sql = $connect->prepare("SELECT * FROM ingredients WHERE status_ingredient = 1 AND id_user = ?");
                            $ingredient_active_sql->execute([$id_user]);
                           
                            while($ingredient_active = $ingredient_active_sql->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($ingredient_active['name_ingredient'])?></td>
                                    <td>
                                        <?php

                                            $ingredient_active_item_sql = $connect->prepare("SELECT * FROM stocks WHERE id_ingredient = ?");
                                            $ingredient_active_item_sql->execute([$ingredient_active['id_ingredient']]);

                                            $stock_left = 0;
                                            while($ingredient_active_item = $ingredient_active_item_sql->fetch(PDO::FETCH_ASSOC)){
                                                $stock_left = $stock_left + $ingredient_active_item['val_stock'];

                                            }
                                            echo htmlspecialchars($stock_left);
                                        ?>
                                    </td>
                                    <td>
                                        <?php

                                            if($stock_left >= $ingredient_active['min_unit_ingredient']){
                                                ?>
                                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">In Stock</span>
                                                <?php 
                                            }
                                            if($stock_left > 0 && $stock_left < $ingredient_active['min_unit_ingredient']){
                                                ?>
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Stock Minimum</span>
                                                <?php
                                            }
                                            if($stock_left == 0){
                                                ?>
                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Stock Finish</span>
                                                <?php
                                                
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php include('../../components/user/edit-ingredient.php');?>
                                <?php
                            
                            }
                        ?>
                    </tbody>
    
        
                </table>

                <a href="./ordering.php">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">See Ordering</button>
                </a>
            </div>
        </center>


        <script>
            new DataTable('#ingredients-active');
        </script>


    </main>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../../src/assets/js/validateInput.js"></script>
    <?php $location_index = "../.."; include('../../components/footer.php')?>
</body>
</html>