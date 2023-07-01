<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <a href="/notes" class="text-blue-500 hover:underline">
            go back..
        </a>
        <p class="mt-4"><?= htmlspecialchars($note['body']) ?></p>
        <div class="flex gap-2">
            <button class="bg-yellow-500 text-white p-2 rounded mt-4">
                <a href="/notes/edit?id=<?=$note['id']?>">Edit note</a>
            </button>
        </div>
    </div>
</main>

<?php require base_path("views/partials/footer.php"); ?>



