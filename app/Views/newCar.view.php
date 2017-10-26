<?php require 'partials/header.php'; ?>

<h1>Create new car</h1>
<form action="/users" method="POST">
    <input type="hidden" name="name" value="<?= $_POST['name'] ?>">
    <input type="hidden" name="age" value="<?= $_POST['age'] ?>">
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
