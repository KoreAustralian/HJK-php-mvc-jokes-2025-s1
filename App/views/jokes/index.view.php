<?php
/**
 * index.view.php
 * Displays a searchable list of all jokes with option to add a new joke.
 *
 * Filename:        index.view.php
 * Location:        App/jokes
 * Project:         HJK-SaaS-Vanilla-MVC-2025-S1
 * Date Created:    20/08/2024
 *
 * Author:          HONG JAE KIM<20115830@tafe.wa.edu.au>
 *
 */

loadPartial('header');
loadPartial('navigation');
?>

<main class="max-w-5xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Browse Jokes</h1>

    <form method="GET" action="/jokes" class="mb-6 flex">
        <input type="text" name="query" placeholder="Search jokes..." class="flex-grow p-2 border rounded-l" value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
        <button type="submit" class="bg-blue-600 text-white px-4 rounded-r">Search</button>
    </form>

    <div class="mb-4">
        <a href="/jokes/create" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            New Joke
        </a>
    </div>

    <!-- joke list -->
    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-100 text-left">
            <th class="border p-2">Title</th>
            <th class="border p-2">Category</th>
            <th class="border p-2">Tags</th>
            <th class="border p-2">Author</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($jokes as $joke): ?>
            <tr>
                <td>
                    <a href="/jokes/<?= $joke['id'] ?>" class="text-blue-600 underline hover:text-blue-800">
                        <?= htmlspecialchars($joke['title']) ?>
                    </a>
                </td>
                <td><?= htmlspecialchars($joke['category_name'] ?? 'Unknown') ?></td>
                <td><?= htmlspecialchars($joke['tags'] ?? '') ?></td>
                <td><?= htmlspecialchars($joke['author_name'] ?? 'Unknown') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php
loadPartial('footer');
?>
