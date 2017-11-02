<?php use Nick\Framework\Request;
use Nick\Framework\Session; ?>

<nav>
    <ul>
        <li><a class="navbar" href="<?= Request::baseUrl(); ?>/">Home</a></li>
        <li><a class="authenticator-button"
               href="https://github.com/login/oauth/authorize?client_id=d77abb39c2b95aa9efb7&redirect_uri=http://localhost:8888/callback&scope=user">
                Login with Github
            </a></li>
        <?= Session::get('authenticatedUser')
            ? '<li><a class="authenticator-button" href="/logout">Logout</a></li>'
            : '<li><a class="authenticator-button" href="/login">Login</a></li>' ?>
        <?php if (!Session::get('authenticatedUser')) : ?>
            <li><a class="authenticator-button" href="/newUser">Register</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
