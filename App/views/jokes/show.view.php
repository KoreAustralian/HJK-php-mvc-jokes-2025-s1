<?php
/**
 * show.view.php
 *
 * Displays detailed view of a selected joke, with edit option for the author.
 *
 * Filename:        show.view.php
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

<main class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($joke['title'] ?? 'Untitled') ?></h1>

    <div class="mb-4 text-gray-600 italic">
        Category: <?= htmlspecialchars($joke['category'] ?? 'Unknown') ?> |
        Tags: <?= htmlspecialchars($joke['tags'] ?? '-') ?>
    </div>

    <article class="prose mb-6">
        <p><?= nl2br(htmlspecialchars($joke['body'] ?? 'No content available.')) ?></p>
    </article>

    <footer class="text-gray-500 text-sm">
        Written by <?= htmlspecialchars($joke['author'] ?? 'Unknown') ?>
    </footer>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $joke['author_id']): ?>
        <a href="/jokes/edit/<?= $joke['id'] ?>" class="inline-block mt-4 px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
            Edit Joke
        </a>
    <?php endif; ?>
</main>

<?php
loadPartial('footer');
?>
