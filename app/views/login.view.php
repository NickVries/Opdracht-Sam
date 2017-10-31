<?php require 'partials/header.php';?>

<h1>Login</h1>

<form action="/login" method="POST">
    <label>
        Username:
        <input type="text" name="username">
    </label>
    <div class="error"><?= !empty($errors['usernameError']) ? $errors['usernameError'] : ''; ?></div>
    <label>
        Password:
        <input type="password" name="password">
    </label>
    <div class="error"><?= !empty($errors['passwordError']) ? $errors['passwordError'] : ''; ?></div>
    <button>Submit</button>
    <div class="error"><?= !empty($errors['loginFailed']) ? $errors['loginFailed'] : ''; ?></div>
</form>

<?php require 'partials/footer.php'; ?>
