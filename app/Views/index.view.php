<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    <table>
        <tr>
            <th>Users</th>
            <th>Cars</th>
        </tr>
        <?php $currentId = null; foreach ($usersWithCars as $userId => $userWithCar) : ?>
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
</body>
</html>

<!--Alternatieve manier om users 1x te laten voorkomen-->
<!--Is de user id al een keer in de tabel gezet?-->

