<?php $title = "Login";$location_index = "."; include('./components/head.php');?>

<body>
    <main>
        <?php $location_index = "."; include('./components/nav.php');?>

        <center>

            <div style="max-width:700px;text-align:left">
    
                <section class="">
                    <div class="flex flex-col items-center justify-center px-2 py-8 mx-auto md:h-screen lg:py-0">
                        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark-text-white">
                            <img class="h-12 mr-2" src="./src/assets/images/logo-banner.png" alt="logo">
                        </a>
                        <div class="w-full bg-white rounded-lg shadow dark-border md:mt-0 sm:max-w-md xl:p-0 dark-bg-gray-800 dark-border-gray-700">
                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark-text-white">
                                    Create an account
                                </h1>
                                <form class="space-y-4 md:space-y-6" method="post" action="./backend/user.php">
                                    <input type="hidden" name="token" value="<?php echo $token?>">
                                    <div>
                                        <label for="name_user" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Your Name</label>
                                        <input type="text" name="name_user" id="name_user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark-bg-gray-700 dark-border-gray-600 dark-placeholder-gray-400 dark-text-white dark-focus:ring-primary-500 dark-focus:border-primary-500" required="">
                                    </div>
                                    <div>
                                        <label for="email_user" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Your email</label>
                                        <input type="email" name="email_user" id="email_user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark-bg-gray-700 dark-border-gray-600 dark-placeholder-gray-400 dark-text-white dark-focus:ring-primary-500 dark-focus:border-primary-500" required="">
                                    </div>
                                    <div>
                                        <label for="password_user" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Password</label>
                                        <input type="password" name="password_user" id="password_user" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark-bg-gray-700 dark-border-gray-600 dark-placeholder-gray-400 dark-text-white dark-focus:ring-primary-500 dark-focus:border-primary-500" required="">
                                    </div>
                                    <div>
                                        <label for="password_confirm_user" class="block mb-2 text-sm font-medium text-gray-900 dark-text-white">Confirm password</label>
                                        <input type="password" name="password_confirm_user" id="password_confirm_user" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark-bg-gray-700 dark-border-gray-600 dark-placeholder-gray-400 dark-text-white dark-focus:ring-primary-500 dark-focus:border-primary-500" required="">
                                    </div>
                                    <!-- <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark-bg-gray-700 dark-border-gray-600 dark-focus:ring-blue-600 dark-ring-offset-gray-800" required="">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="terms" class="font-light text-gray-500 dark-text-gray-300">I accept the <a class="font-medium text-blue-600 hover:underline dark-text-primary-500" href="#">Terms and Conditions</a></label>
                                        </div>
                                    </div> -->
                                    <button type="submit" name="signup" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark-bg-blue-600 dark-hover:bg-blue-700 dark-focus:ring-blue-800">Create an account</button>
                                    <p class="text-sm font-light text-gray-500 dark-text-gray-400">
                                        Already have an account? <a href="./signin.php" class="font-medium text-blue-600 hover:underline dark-text-primary-500">Login here</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    </section>

            </div>
        </center>
    </main>

    <script src="./node_modules/flowbite/dist/flowbite.min.js"></script>
    <?php $location_index = "."; include('./components/footer.php')?>
</body>
</html>