<?php use Nick\Framework\Request;
use Nick\Framework\Session; ?>

<nav>
    <ul>
        <li><a class="navbar" href="<?= Request::baseUrl(); ?>/">Home</a></li>
        <?php if (Session::get('authenticatedUser')) : ?>
            <li><a class="authenticator-button" href="/logout">Logout</a></li>
            <li>
                <a class='navbar' href="<?= Request::baseUrl(); ?>/edit-bio">
                    Edit GitHub profile
                </a>
            </li>
        <?php else : ?>
            <li><a class="authenticator-button" href="/login">Login</a></li>
        <?php endif; ?>
        <?php if (!Session::get('authenticatedUser')) : ?>
            <li><a class="authenticator-button" href="/newUser">Register</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
