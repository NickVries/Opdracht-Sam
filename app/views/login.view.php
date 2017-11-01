<?php require 'partials/header.php';?>

<?php if ($authenticatedUser) : ?>
<h1>You're already logged in, <?= $authenticatedUser->name ?>!</h1>
<?php endif; ?>
<?php if (!$authenticatedUser) : ?>

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

<?php endif; ?>

<?php require 'partials/footer.php'; ?>
