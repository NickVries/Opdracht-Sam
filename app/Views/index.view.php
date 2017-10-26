<?php require 'partials/header.php'; ?>

<h1>Current Users</h1>

<table>
    <tr>
        <th>Users</th>
        <th>Cars</th>
    </tr>
    <?php $currentId = null;
    foreach ($usersWithCars as $userId => $userWithCar) : ?>
        <?php foreach ($userWithCar->garage as $car) : ?>
            <tr>
                <?php if ($userId !== $currentId) : ?>
                    <td rowspan="<?= $userWithCar->getCarCount(); ?>"><?= $userWithCar->name; ?></td>
                <?php endif; ?>
                <td><?= "{$car->color} {$car->brand}" ?></td>
            </tr>
            <?php $currentId = $userId; endforeach; ?>
    <?php endforeach; ?>
</table>

<a href="/newUser">Create new user</a>

<?php require 'partials/footer.php'; ?>

