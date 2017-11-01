<?php require 'Partials/header.php';?>
<div class="avatars">
<?php foreach ($avatarUrls as $url) : ?>
<img class="avatar" src="<?= $url ?>" alt="">
<?php endforeach; ?>
</div>

<?php require 'Partials/footer.php'; ?>
