<?php
/**
 * Page 'Header' and Navigation
 *
 * Filename:        navigation.view.php
 * Location:        App/views/partials
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    20/08/2024
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

use Framework\Middleware\Authorise;

$authenticated = new Authorise();
?>

<header class="bg-gray-950 text-gray-200 p-4 flex-grow-0 flex flex-row align-middle content-center mb-4">
    <h1 class="flex-0 w-32 text-xl p-4 ">
        <a href="#"
           class="py-4 px-4 -mx-4 -my-4 font-display font-bold rounded
             text-pink-500 hover:text-black
             hover:bg-prussianblue-500
                 transition ease-in-out duration-700">
            MVC
        </a>
    </h1>
    <nav class="flex flex-row py-4 flex-grow ml-8">
        <ul class="flex flex-row gap-4 flex-grow">
            <li>
                <a href="/"
                   class="pb-2 px-1 text-gray-400 hover:text-gray-300
                     border-0 border-b-2 border-b-prussianblue-500 hover:border-b-gray-500
                     transition ease-in-out duration-500">
                    Home
                </a>
            </li>

            <?php
            if ($authenticated->isAuthenticated()) {
                ?>
                <li>
                    <a href="/auth/edit"
                       class="pb-2 px-1 text-gray-400 hover:text-gray-300
                     border-0 border-b-2 hover:border-b-gray-500
                     transition ease-in-out duration-500">
                        Users
                    </a>
                </li>
                <?php
            }
            ?>

            <li>
                <a href="/jokes"
                   class="pb-2 px-1 text-gray-400 hover:text-gray-300
                     border-0 border-b-2 hover:border-b-gray-500
                     transition ease-in-out duration-500">
                    Jokes
                </a>
            </li>
            <li>
                <a href="#"
                   class="pb-2 px-1 text-gray-400 hover:text-gray-300
                     border-0 border-b-2 hover:border-b-gray-500
                     transition ease-in-out duration-500">
                    Link 1
                </a>
            </li>
            <li>
                <a href="#"
                   class="pb-2 px-1 text-gray-400 hover:text-gray-300
                     border-0 border-b-2 hover:border-b-gray-500
                     transition ease-in-out duration-500">
                    Link 1
                </a>
            </li>
        </ul>

        <ul class="flex flex-row gap-4">
            <?php
            if (!$authenticated->isAuthenticated()) {
                ?>
                <li>
                    <form method="GET" action="/auth/login" class="">
                        <button class="pb-2 px-1 text-sm text-gray-400 hover:text-gray-300
                     border-0 border-b-2 hover:border-b-gray-500
                     transition ease-in-out duration-500">
                            <i class="fa fa-door-open"></i> Login
                        </button>
                    </form>
                </li>
                <li>
                    <form method="GET" action="/auth/register" class="">
                        <button class="pb-2 px-1 text-sm text-gray-400 hover:text-gray-300
                     border-0 border-b-2 hover:border-b-gray-500
                     transition ease-in-out duration-500">
                            <i class="fa fa-person-pregnant"></i> Register
                        </button>
                    </form>
                </li>
                <?php
            } else {
                ?>
                <li>
                    <form method="POST" action="/auth/logout" class="">
                        <button class="pb-2 px-1 text-sm text-gray-400 hover:text-gray-300
                     border-0 border-b-2 hover:border-b-gray-500
                     transition ease-in-out duration-500">
                            <i class="fa fa-door-closed"></i> Logout
                        </button>
                    </form>
                </li>
                <?php
            }
            ?>

            <li>
                <form method="GET" action="/jokes" class="block mx-5 flex">
                    <input type="text" name="query" placeholder="Search jokes..."
                           class="w-full md:w-auto px-4 py-1 border border-gray-800 focus:outline-none focus:border-b-gray-500"/>
                    <button class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 focus:outline-none transition ease-in-out duration-500">
                        <i class="fa fa-search"></i> Search
                    </button>
                </form>
            </li>

        </ul>

    </nav>
</header>