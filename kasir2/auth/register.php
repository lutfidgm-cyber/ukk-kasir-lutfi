<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register User</h2>

<form action="proses_register.php" method="post">
    Username <br>
    <input type="text" name="username" required><br><br>

    Password <br>
    <input type="password" name="password" required><br><br>

    Role <br>
    <select name="role">
        <option value="kasir">Kasir</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit">Register</button>
</form>

</body>
</html>
