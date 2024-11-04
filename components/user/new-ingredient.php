

<!-- Main modal -->
<div id="new-ingredient-modal" tabindex="-1" aria-hidden="true" class="text-left hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark-bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark-border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark-text-white">
                    Add new ingredient
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark-hover:bg-gray-600 dark-hover:text-white" data-modal-hide="new-ingredient-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" method="post" action="<?php echo $location_index?>/backend/ingredient.php">
                    <input type="hidden" name="token" value="<?php echo $token?>">                    

                    <div>
                        <label for="name_ingredient" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Ingredient Name</label>
                        <input type="text" name="name_ingredient" id="name_ingredient" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark-bg-gray-600 dark-border-gray-500 dark-placeholder-gray-400 dark-text-white" required />
                    </div>

                    <label for="unit_ingredient" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Select a Unit</label>
                    <select id="unit_ingredient" name="unit_ingredient" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark-bg-gray-700 dark-border-gray-600 dark-placeholder-gray-400 dark-text-white dark-focus:ring-primary-500 dark-focus:border-primary-500" required>
                        <option selected value="g">Grams</option>
                        <option value="kg">Kilograms</option>
                        <option value="ml">Milliliter</option>
                        <option value="l">Liter</option>
                        <option value="bag">Bag</option>
                        <option value="Box">Box</option>
                    </select>

                    <div>
                        <label for="min_unit_ingredient" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Minimal Stock Unit</label>
                        <input type="text" onkeypress="return isNumberKey(event)" name="min_unit_ingredient" id="min_unit_ingredient" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark-bg-gray-600 dark-border-gray-500 dark-placeholder-gray-400 dark-text-white" required/>
                    </div>

                    <button type="submit" name="create_ingredient" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark-bg-blue-600 dark-hover:bg-blue-700 dark-focus:ring-blue-800">Set Ingredient</button>
                </form>
            </div>
        </div>
    </div>
</div> 
