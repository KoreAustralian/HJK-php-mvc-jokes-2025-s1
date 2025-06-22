<?php
/**
 * create.view.php
 *
 * Displays the form for creating a new joke.
 *
 * Filename:        create.view.php
 * Location:        /
 * Project:         HJK-SaaS-Vanilla-MVC-2025-S1
 * Date Created:    20/08/2024
 *
 * Author:          HONG JAE KIM<20115830@tafe.wa.edu.au>
 *
 */

loadPartial('header');
loadPartial('navigation');
?>

<main class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Add a New Joke</h1>

    <?php include basePath('App/views/partials/message.view.php'); ?>

    <form method="POST" action="/jokes" class="space-y-4">
        <div>
            <label for="title" class="block font-medium">Title *</label>
            <input type="text" name="title" id="title" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label for="body" class="block font-medium">Content *</label>
            <textarea name="body" id="body" required class="w-full border p-2 rounded" rows="5"></textarea>
        </div>

        <div>
            <label for="category_id" class="block font-medium">Category *</label>
            <select name="category_id" id="category_id" required class="w-full border p-2 rounded">
                <option value="1" selected>Unknown Category</option>
                <option value="11">Dad Joke</option>
                <option value="9">Geek</option>
                <option value="10">Programmer</option>
                <option value="2">Web</option>
                <option value="3">Knock-Knock</option>
                <option value="4">Rude</option>
                <option value="5">Dog</option>
                <option value="6">Cat</option>
                <option value="7">Halloween</option>
                <option value="8">Animal</option>
            </select>
        </div>

        <div>
            <label for="tags" class="block font-medium">Tags (comma-separated)</label>
            <input type="text" name="tags" id="tags" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Submit Joke
        </button>
    </form>
</main>

<?php
loadPartial('footer');
?>
