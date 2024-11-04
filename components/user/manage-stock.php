<!-- Main modal -->
<div id="manage-stock-modal_<?php echo $stock_active['id_stock'] ?>" tabindex="-1" aria-hidden="true" class="text-left hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark-bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark-border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark-text-white">
                    Manage Stock
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark-hover:bg-gray-600 dark-hover:text-white" data-modal-hide="manage-stock-modal_<?php echo $stock_active['id_stock'] ?>">
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
                    <input type="hidden" name="id_stock" value="<?php echo $stock_active['id_stock']?>">

                    <div class="relative mb-6 mt-4 rounded bg-white">
                        <div>
                            <?php 
                                $ingredient_id_stock_sql = $connect->prepare("SELECT * FROM ingredients WHERE id_ingredient = ? AND status_ingredient = 1");
                                $ingredient_id_stock_sql->execute([$stock_active['id_ingredient']]);
                                $ingredient_id_stock = $ingredient_id_stock_sql->fetch(PDO::FETCH_ASSOC);

                            ?>
                            <label for="name_ingredient" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Ingredient Name</label>
                            <input type="text" name="name_ingredient" id="name_ingredient" value="<?php echo $ingredient_id_stock['name_ingredient']?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark-bg-gray-600 dark-border-gray-500 dark-placeholder-gray-400 dark-text-white" required readonly />
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="exp_date_stock" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Expired Date</label>
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="exp_date_stock_<?php echo$stock_active['id_stock'] ?>" name="exp_date_stock" value="<?php echo $stock_active['exp_date_stock']?>" datepicker datepicker-autoselect-today datepicker-format="yyyy-mm-dd" datepicker-min-date="<?php echo date("d/m/Y")?>" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Select date">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <div>
                            <label for="val_stock" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Number of Stock</label>
                            <input type="text" onkeypress="return isNumberKey(event)" name="val_stock" value="<?php echo $stock_active['val_stock']?>" id="val_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark-bg-gray-600 dark-border-gray-500 dark-placeholder-gray-400 dark-text-white" required/>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="cost_stock" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Cost Stock (RM per )</label>
                        <input type="text" onkeypress="return isNumberKey(event)" name="cost_stock" value="<?php echo $stock_active['cost_stock']?>" id="cost_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark-bg-gray-600 dark-border-gray-500 dark-placeholder-gray-400 dark-text-white" required placeholder="RM"/>
                    </div>

                    <button type="submit" name="save_stock" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save Stock</button>
                </form>

                <form action="<?php echo $location_index?>/backend/stock.php" method="post">

                    <input type="hidden" name="token" value="<?php echo $token?>">
                    <input type="hidden" name="id_stock" value="<?php echo $stock_active['id_stock']?>">

                    <br>
                    <button type="submit" name="clear_stock" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Clear Stock</button>
                </form>
            </div>
        </div>
    </div>
</div> 