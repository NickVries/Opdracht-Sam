<?php require 'partials/header.php'; ?>

<?= ($authenticatedUser)
    ? "<a class=\"authenticator-button\" href=\"/logout\">Logout</a>"
    : "<a class=\"authenticator-button\" href=\"/login\">Login</a> 
       <a class=\"authenticator-button\" href=\"/newUser\">Register</a>"; ?>

<?= ($authenticatedUser) ? "<h2>Welcome {$authenticatedUser->name}!</h2>"
    : ''; ?>

<h1>Current Users</h1>

<table>
    <tr>
        <th>Users</th>
        <th>Cars</th>
        <?php if ($authenticatedUser) : ?>
        <th>Got another car?</th>
        <?php endif; ?>
    </tr>
    <?php $currentId = null;
    foreach ($usersWithCars as $userId => $userWithCar) : ?>
        <?php foreach ($userWithCar->garage as $car) : ?>
            <tr>
                <?php if ($userId !== $currentId) : ?>
                    <td rowspan="<?= $userWithCar->getCarCount(); ?>"><?= $userWithCar->name ?></td>
                <?php endif; ?>
                <td><?= "{$car->color} {$car->brand}" ?></td>
                <?php if ($authenticatedUser) : ?>
                <?php if ($userId !== $currentId) : ?>
                    <td class="add-car-cell"
                        rowspan="<?= $userWithCar->getCarCount(); ?>"
                    >
                        <?php if ($userId == $authenticatedUser->id) : ?>
                        <a class="add-car-button"
                           href="/newUser"
                        >
                            Add car
                        </a>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
                <?php endif; ?>
            </tr>
            <?php $currentId = $userId; endforeach; ?>
    <?php endforeach; ?>
</table>


<?php require 'partials/footer.php'; ?>

