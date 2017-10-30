<?php require 'Partials/header.php';?>

<h1>Login</h1>

<form action="/login" method="POST">
    <label>
        Username:
        <input type="text" name="username">
    </label>
    <span class="error"><?= !empty($errors['usernameError']) ? $errors['usernameError'] : ''; ?></span>
    <label>
        Password:
        <input type="text" name="password">
    </label>
    <span class="error"><?= !empty($errors['passwordError']) ? $errors['passwordError'] : ''; ?></span>
    <button>Submit</button>
</form>

<?php require 'Partials/footer.php'; ?>
