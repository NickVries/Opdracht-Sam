<?php require 'partials/header.php'; ?>

<h1>Create new user</h1>

<form action="/users" method="POST">
    Name: <br>
    <input type="text" name="name"><br>
    Age: <br>
    <input type="integer" name="age"><br>
    Car: <br>
    <select name="car">
        <option value="Blue VW">Blue VW</option>
        <option value="Red Volvo">Red Volvo</option>
        <option value="Yellow Toyota">Yellow Toyota</option>
        <option value="Blue Volvo">Blue Volvo</option>
<!--        <option value="/">Other</option>-->
    </select><br>
    <button>Submit</button>
</form>
<?php require 'partials/footer.php'; ?>



