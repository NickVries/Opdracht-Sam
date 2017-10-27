<?php require 'partials/header.php'; ?>

<?= empty($_GET) ? '<h1>Create new user</h1>' : '<h1>Add a car</h1>' ?>

<form action="<?= empty($_GET) ? '/users' : '/addCarToUser' ?>" method="POST">
    <label>
        Name:
        <input type="text" name="name" <?= !empty($_GET['name']) ? "value={$_GET['name']} readonly" : '' ?>>
    </label>
    <label>
        Age:
        <input type="integer" name="age" <?= !empty($_GET['age']) ? "value={$_GET['age']} readonly" : '' ?>>
    </label>
    <?= empty($_GET) ? '' : "<input type='hidden' name='id' value=\"{$_GET['id']}\">" ?>
    <label>
        Car:
        <select name="car">
            <?php foreach ($allCars as $car) : ?>
                <option value="<?= $car->id ?>"><?= "{$car->color} {$car->brand}" ?></option>
            <?php endforeach; ?>
            <?= empty($_GET) ? '<option value="other">Other</option>' : null ?>
        </select>
    </label>
    <button>Submit</button>
</form>
<?php require 'partials/footer.php'; ?>



