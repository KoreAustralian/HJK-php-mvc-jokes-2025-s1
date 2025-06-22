<?php
/**
 * about.view.php
 *
 * Displays information about the application and its developer.
 *
 * Filename:        about.view.php
 * Location:        App/
 * Project:         HJK-SaaS-Vanilla-MVC-2025-S1
 * Date Created:    20/08/2024
 *
 * Author:          HONG JAE KIM<20115830@tafe.wa.edu.au>
 *
 */

loadPartial('header');
loadPartial('navigation');
?>

<main class="max-w-4xl mx-auto px-4 py-6">
    <section class="mb-6">
        <h1 class="text-3xl font-bold mb-4">About This Application</h1>
        <p class="text-gray-600 mb-4">
            This web application is a simple Joke Management System created as part of the ICT50220 Diploma of Information Technology (Advanced Programming).
        </p>

        <h2 class="text-2xl font-semibold mb-2">Developer</h2>
        <p class="mb-4">HongJae Kim (Student ID: 20115830)</p>

        <h2 class="text-2xl font-semibold mb-2">Technologies Used</h2>
        <ul class="list-disc list-inside text-gray-700">
            <li>PHP 8.2+</li>
            <li>Micro-MVC Framework (based on Traversy Media tutorial)</li>
            <li>TailwindCSS</li>
            <li>MySQL / MariaDB</li>
            <li>CKEditor (for joke editor)</li>
        </ul>
    </section>
</main>

<?php
loadPartial('footer');
?>
