<?php require 'partials/header.php'; ?>
<div class="avatars">
    <?php foreach ($users as $user) : ?>
        <div>
            <img class="avatar" src="<?= $user['avatar'] ?>" alt="">
        <ul>
            <?php foreach ($user['classifiers'] as $classifier) : ?>
                <li><?= "{$classifier->class} {$classifier->score}" ?></li>
            <?php endforeach; ?>
        </ul>
        </div>
    <?php endforeach; ?>
</div>

<?php require 'partials/footer.php'; ?>
