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
            <option value="1">Blue VW</option>
            <option value="2">Red Volvo</option>
            <option value="3">Yellow Toyota</option>
            <option value="4">Blue Volvo</option>
            <option value="other">Other</option>
        </select>
    </label>
    <button>Submit</button>
</form>
<?php require 'partials/footer.php'; ?>



