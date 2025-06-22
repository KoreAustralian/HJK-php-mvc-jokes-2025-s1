<?php
/**
 * edit.view.php
 * Displays a form for editing or deleting an existing joke.
 *
 * Filename:        edit.view.php
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
    <h1 class="text-2xl font-bold mb-4">Edit Joke</h1>

    <?php include basePath('App/views/partials/message.view.php'); ?>

    <form method="POST" action="/jokes/edit/<?= $joke['id'] ?>" class="space-y-4">
        <div>
            <label for="content" class="block font-medium">Content *</label>
            <textarea name="content" id="content" required class="w-full border p-2 rounded" rows="5"><?= htmlspecialchars($joke['content']) ?></textarea>
        </div>

        <div>
            <label for="category" class="block font-medium">Category *</label>
            <select name="category" id="category" required class="w-full border p-2 rounded">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat ?>" <?= $cat === $joke['category'] ? 'selected' : '' ?>>
                        <?= $cat ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="tags" class="block font-medium">Tags</label>
            <input type="text" name="tags" id="tags" class="w-full border p-2 rounded" value="<?= htmlspecialchars($joke['tags']) ?>">
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
            Update Joke
        </button>
    </form>

    <form method="POST" action="/jokes/delete/<?= $joke['id'] ?>" class="mt-4">
        <button type="submit" onclick="return confirm('Are you sure you want to delete this joke?');"
                class="bg-red-600 text-white px-4 py-2 rounded">
            Delete Joke
        </button>
    </form>
</main>

<?php
loadPartial('footer');
?>
