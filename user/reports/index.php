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
                            <th>Date</th>
                            <th>Cost</th>
                            <th><center>Manage</center></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            $ingredient_active_sql = $connect->prepare("SELECT * FROM ingredients WHERE status_ingredient = 1");
                            $ingredient_active_sql->execute();
                           
                            while($ingredient_active = $ingredient_active_sql->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($ingredient_active['name_ingredient'])?></td>
                                    <td><?php echo htmlspecialchars($ingredient_active['unit_ingredient'])?></td>
                                    <td>
                                        <center>

                                            <div class="flex align-center justify-center manage-buttons">

                                                <form class="pr-2" action="../../backend/ingredient.php" method="post">
                                                    
                                                    <input type="hidden" name="id_ingredient" value="<?php echo $ingredient_active['id_ingredient']?>">
                                                    <input type="hidden" name="token" value="<?php echo $token?>">
                                                    <input type="submit" style="color:white !important" class="block bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark-bg-red-600 dark-hover:bg-red-700 dark-focus:ring-red-800" name="delete_ingredient" value="Delete">
                                                </form>

                                                <div style="text-align: center;">
                                                    <button data-modal-target="edit-ingredient-modal_<?php echo $ingredient_active['id_ingredient'] ?>" data-modal-toggle="edit-ingredient-modal_<?php echo $ingredient_active['id_ingredient'] ?>" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark-bg-blue-600 dark-hover:bg-blue-700 dark-focus:ring-blue-800" type="button">
                                                        Edit
                                                    </button> 
                                                </div>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <?php include('../../components/user/edit-ingredient.php');?>
                                <?php
                            
                            }
                        ?>
                    </tbody>
    
        
                </table>

                <button data-modal-target="new-ingredient-modal" data-modal-toggle="new-ingredient-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark-bg-blue-600 dark-hover:bg-blue-700 dark-focus:ring-blue-800" type="button">
                    Set New Ingredient
                </button>
            </div>
        </center>


        <script>
            new DataTable('#ingredients-active');
        </script>


    </main>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <?php $location_index = "../.."; include('../../components/footer.php')?>
</body>
</html>