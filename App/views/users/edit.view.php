<?php
loadPartial('header');
loadPartial('navigation');
?>

<main class="container mx-auto bg-zinc-50 py-8 px-4 shadow rounded-b-lg mt-8 w-1/2">
    <section class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-4xl font-bold mb-4">Edit Profile</h2>

        <?= loadPartial('errors',['errors'=>$errors??[]]) ?>

        <form method="POST" action="/auth/edit">

            <div class="mb-4">
                <label for="given_name">Given Name:</label>
                <input id="given_name" name="given_name" type="text"
                       class="w-full border px-4 py-2 rounded"
                       value="<?= htmlspecialchars($user['given_name'] ?? '') ?>">
            </div>

            <div class="mb-4">
                <label for="family_name">Family Name:</label>
                <input id="family_name" name="family_name" type="text"
                       class="w-full border px-4 py-2 rounded"
                       value="<?= htmlspecialchars($user['family_name'] ?? '') ?>">
            </div>

            <div class="mb-4">
                <label for="nickname">Nickname:</label>
                <input id="nickname" name="nickname" type="text"
                       class="w-full border px-4 py-2 rounded"
                       value="<?= htmlspecialchars($user['nickname'] ?? '') ?>">
            </div>

            <div class="mb-4">
                <label for="city">City:</label>
                <input id="city" name="city" type="text"
                       class="w-full border px-4 py-2 rounded"
                       value="<?= htmlspecialchars($user['city'] ?? '') ?>">
            </div>

            <div class="mb-4">
                <label for="state">State:</label>
                <input id="state" name="state" type="text"
                       class="w-full border px-4 py-2 rounded"
                       value="<?= htmlspecialchars($user['state'] ?? '') ?>">
            </div>

            <div class="mb-4">
                <label for="country">Country:</label>
                <input id="country" name="country" type="text"
                       class="w-full border px-4 py-2 rounded"
                       value="<?= htmlspecialchars($user['country'] ?? '') ?>">
            </div>

            <div class="flex gap-4">
                <button type="submit"
                        class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Save
                </button>
                <a href="/dashboard"
                   class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-center">
                    Cancel
                </a>
            </div>
        </form>
    </section>
</main>

<?php loadPartial('footer'); ?>
