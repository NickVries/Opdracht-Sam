<?php require 'partials/header.php'; ?>

<h1>Edit your github bio</h1>

<form action="/save-bio" method="POST">
    <label>
        <textarea name="bio" id="" cols="30" rows="10"><?= $bio; ?></textarea>
    </label>
    <button>Save</button>
</form>

<?php require 'partials/footer.php'; ?>
