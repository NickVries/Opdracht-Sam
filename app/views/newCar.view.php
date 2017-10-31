<?php require 'partials/header.php'; ?>

<h1>Create new car</h1>
<form action="/users" method="POST">
    <input type="hidden" name="name" value="<?= $_GET['name'] ?>">
    <input type="hidden" name="age" value="<?= $_GET['age'] ?>">
    <label>
        Brand:
        <input type="text" name="brand">
    </label>
    <label>
        Color:
        <input type="text" name="color">
    </label>
    <button>Submit</button>
</form>

<?php require 'partials/footer.php'; ?>
