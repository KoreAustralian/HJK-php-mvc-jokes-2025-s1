<?php
/**
 * Index Page View
 *
 * Filename:        index.view.php
 * Location:        /App/views
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    23/08/2024
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

loadPartial('header');
loadPartial('navigation');

?>

<main class="max-w-4xl mx-auto px-4 py-6">
    <?php include basePath('App/views/partials/message.view.php'); ?>

    <section class="mb-6">
        <h1 class="text-3xl font-bold mb-4">Welcome to the Jokes System</h1>
        <p class="text-gray-600">This is the home page. As a guest, you can register, log in, and search for jokes.</p>
    </section>

    <form method="GET" action="/search" class="mb-4 flex">
        <input type="text" name="query" placeholder="Search jokes..." class="flex-grow p-2 border rounded-l-md focus:outline-none">
        <button type="submit" class="bg-blue-600 text-white px-4 rounded-r-md">Search</button>
    </form>

    <form method="POST">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700">
            New Joke
        </button>
    </form>

    <div class="mt-6 p-4 bg-gray-100 rounded shadow text-center">
        <p class="text-gray-500 italic">
            No jokes to display yet. This section will be updated once the Jokes feature is implemented.
        </p>
    </div>
</main>

<?php
loadPartial('footer');
?>
