

<!-- Main modal -->
<div id="new-stock-modal" tabindex="-1" aria-hidden="true" class="text-left hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark-bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark-border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark-text-white">
                    Add new stock
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark-hover:bg-gray-600 dark-hover:text-white" data-modal-hide="new-stock-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" method="post" action="<?php echo $location_index?>/backend/stock.php">
                    <input type="hidden" name="token" value="<?php echo $token?>">                    

                    <div class="relative mb-6 mt-4 rounded bg-white">
                        <label for="id_ingredient" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Ingredient</label>
                        <select style="z-index:-100 !important" name="id_ingredient" class="rounded-md bg-white" data-te-select-init data-te-select-filter="true" required>
                            <!-- <option value="0">Nama Ingredient</option> -->
                            <?php 
                                $user_value = decryptUser($_SESSION['MyCookingInventoryUserHash'], $secret_key);
                                $id_user = $user_value['id_user'];

                                $ingredient_id_stock_sql = $connect->prepare("SELECT * FROM ingredients WHERE id_user = ? AND status_ingredient = 1");
                                $ingredient_id_stock_sql->execute([$id_user]);

                                while($ingredient_id_stock = $ingredient_id_stock_sql->fetch(PDO::FETCH_ASSOC)){
                                    ?>

                                    <option value="<?php echo $ingredient_id_stock['id_ingredient']?>"><?php echo htmlspecialchars($ingredient_id_stock['name_ingredient'])?> - (<?php echo htmlspecialchars($ingredient_id_stock['unit_ingredient'])?>)</option>

                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <label for="exp_date_stock" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Expired Date</label>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="exp_date_stock_val" name="exp_date_stock" datepicker datepicker-format="yyyy-mm-dd" datepicker-min-date="<?php echo date("d/m/Y")?>" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Select date">
                    </div>

                    <div>
                        <label for="val_stock" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Number of Unit</label>
                        <input type="text" onkeypress="return isNumberKey(event)" name="val_stock" id="val_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark-bg-gray-600 dark-border-gray-500 dark-placeholder-gray-400 dark-text-white" required/>
                    </div>
                    <div>
                        <label for="cost_stock" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Cost Stock (RM per Unit)</label>
                        <input type="text" onkeypress="return isNumberKey(event)" name="cost_stock" id="cost_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark-bg-gray-600 dark-border-gray-500 dark-placeholder-gray-400 dark-text-white" required placeholder="RM"/>
                    </div>

                    <button type="submit" name="create_stock" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark-bg-blue-600 dark-hover:bg-blue-700 dark-focus:ring-blue-800">Set Ingredient</button>
                </form>
            </div>
        </div>
    </div>
</div> 
