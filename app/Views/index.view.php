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
        <?php $currentName = ''; foreach ($usersWithCars as $userWithCar) : ?>
            <?php foreach ($userWithCar->garage as $car) : ?>
                <tr>
                    <?php if ($userWithCar->name !== $currentName) : ?>
                        <td rowspan="<?= $userWithCar->getCarCount(); ?>"><?= $userWithCar->name; ?></td>
                    <?php endif; ?>
                    <td><?= "{$car->color} {$car->brand}" ?></td>
                </tr>
            <?php $currentName = $userWithCar->name; endforeach; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>

<!--Namen aan de bovenkant van de row uitgelijnd-->
<!--ipv carcount, functie op de user defineren: getCarCount();-->

