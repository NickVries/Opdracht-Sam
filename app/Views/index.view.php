<?php require 'Partials/header.php'; ?>

<h1>Current Users</h1>

<table>
    <tr>
        <th>Users</th>
        <th>Cars</th>
        <th>Got another car?</th>
    </tr>
    <?php $currentId = null;
    foreach ($usersWithCars as $userId => $userWithCar) : ?>
        <?php foreach ($userWithCar->garage as $car) : ?>
            <tr>
                <?php if ($userId !== $currentId) : ?>
                    <td rowspan="<?= $userWithCar->getCarCount(); ?>"><?= $userWithCar->name ?></td>
                <?php endif; ?>
                <td><?= "{$car->color} {$car->brand}" ?></td>
                <?php if ($userId !== $currentId) : ?>
                <td class="add-car-cell" rowspan="<?= $userWithCar->getCarCount(); ?>">
                    <a class="add-car-button" href="/newUser?id=<?= $userId ?>&name=<?= $userWithCar->name ?>&age=<?= $userWithCar->age ?>">Add car</a>
                </td>
                <?php endif; ?>
            </tr>
            <?php $currentId = $userId; endforeach; ?>
    <?php endforeach; ?>
</table>

<a href="/newUser">Create new user</a>

<?php require 'Partials/footer.php'; ?>

