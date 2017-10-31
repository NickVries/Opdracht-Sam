<?php require 'partials/header.php';?>

<?= empty($_GET['id']) ? '<h1>Create new user</h1>' : '<h1>Add a car</h1>' ?>

<form action="<?= empty($_GET['id']) ? '/users' : '/addCarToUser' ?>" method="POST">
    <label>
        Name:
        <input type="text" name="name" value="<?= $name ?>" <?= $readonly ? 'readonly' : '' ?>>
    </label>
    <span class="error"><?= !empty($errors['nameError']) ? $errors['nameError'] : ''; ?></span>
    <label>
        Age:
        <input type="integer" name="age" value="<?= $age ?>" <?= $readonly ? 'readonly' : '' ?>>
    </label>
    <span class="error"><?= !empty($errors['ageError']) ? $errors['ageError'] : ''; ?></span>
    <?= empty($_GET['id']) ? '' : "<input type='hidden' name='id' value=\"{$_GET['id']}\">" ?>
    <?php if (empty($_GET['id'])): ?>
    <label>
        Username:
        <input type="text" name="username">
    </label>
    <label>
        Password:
        <input type="password" name="password">
    </label>
    <?php endif; ?>
    <label>
        Car:
        <select name="car">
            <?php foreach ((empty($_GET['id']) ? $allCars : $availableCars) as $car) : ?>
                <option value="<?= $car->id ?>"><?= "{$car->color} {$car->brand}" ?></option>
            <?php endforeach; ?>
            <?= empty($_GET['id']) ? '<option value="other">Other</option>' : null ?>
        </select>
    </label>
    <button>Submit</button>
</form>
<?php require 'partials/footer.php'; ?>



