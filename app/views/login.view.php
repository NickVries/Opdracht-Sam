<?php require 'partials/header.php'; ?>

<?php if ($authenticatedUser) : ?>
    <h1>You're already logged in, <?= $authenticatedUser->name ?>!</h1>
<?php else : ?>

    <h1>Login</h1>

    <form action="/login" method="POST">
        <label>
            Username:
            <input type="text" name="username">
        </label>
        <div class="error"><?= !empty($errors['usernameError'])
                ? $errors['usernameError'] : ''; ?></div>
        <label>
            Password:
            <input type="password" name="password">
        </label>
        <div class="error"><?= !empty($errors['passwordError'])
                ? $errors['passwordError'] : ''; ?></div>
        <label class="checkbox">
            <input type="checkbox" name="cookie" value="checked"> Keep Shady
            logged in.
        </label>
        <button>Submit</button>
        <div class="error"><?= !empty($errors['loginFailed'])
                ? $errors['loginFailed'] : ''; ?></div>
    </form>

    <a class="authenticator-button left"
       href="https://github.com/login/oauth/authorize?client_id=d77abb39c2b95aa9efb7&redirect_uri=http://localhost:8888/callback&scope=user">
        Login with Github
    </a>

<?php endif; ?>

<?php require 'partials/footer.php'; ?>
