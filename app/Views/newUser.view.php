<?php require 'partials/header.php'; ?>

<h1>Create new user</h1>

<form action="/users" method="POST">
    <label>
        Name:
        <input type="text" name="name">
    </label>
    <label>
        Age:
        <input type="integer" name="age">
    </label>
    <label>
        Car:
        <select name="car">
            <?php foreach ($allCars as $car) : ?>
                <option value="<?= $car->id ?>"><?= "{$car->color} {$car->brand}" ?></option>
            <?php endforeach; ?>
            <option value="other">Other</option>
        </select>
    </label>
    <button>Submit</button>
</form>
<?php require 'partials/footer.php'; ?>



