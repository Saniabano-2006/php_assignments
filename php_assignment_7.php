<?php
$first_name = $last_name = $email = $gender = $role = $username = $password = "";
$first_error = $last_error = $email_error = $gender_error = $role_error = $username_error = $password_error = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING);
    if (empty($first_name)) {
        $first_error = "First Name is required.";
        $error = true;
    }

    $last_name = filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING);
    if (empty($last_name)) {
        $last_error = "Last Name is required.";
        $error = true;
    }

    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    if (empty($email)) {
        $email_error = "Email is required.";
        $error = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format.";
        $error = true;
    }

    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
        if (empty($gender)) {
            $gender_error = "Gender is required.";
            $error = true;
        }
    } else {
        $gender_error = "Gender is required.";
        $error = true;
    }

    if (isset($_POST['role'])) {
        $role = $_POST['role'];
        if (empty($role)) {
            $role_error = "Role is required.";
            $error = true;
        }
    } else {
        $role_error = "Role is required.";
        $error = true;
    }

    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    if (empty($username)) {
        $username_error = "Username is required.";
        $error = true;
    }

    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    if (empty($password)) {
        $password_error = "Password is required.";
        $error = true;
    } elseif (!preg_match("/^\d{8}$/", $password)) {
        $password_error = "Password must have exactly 8 characters.";
        $error = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    text-align: center;
}

h1 {
    color: #333;
    margin-top: 50px;
}

.form {
    background-color: #fff;
    width: 500px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: left;
    
}

input[type="text"], 
input[type="email"], 
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="radio"] {
    margin-right: 5px;
}

.error {
    color: red;
    font-size: 12px;
    margin-top: -10px;
    margin-bottom: 10px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

table {
    width: 50%;
    margin: 30px auto;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

    </style>
</head>
<body>
    <h1>REGISTRATION FORM</h1>
    <form class="form" action="" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($first_name) ?>"><br>
        <span class="error"> * <?php echo $first_error; ?></span>
        <br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($last_name) ?>"><br>
        <span class="error"> * <?php echo $last_error; ?></span>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>"><br>
        <span class="error"> * <?php echo $email_error; ?></span>
        <br>

        <label for="gender">Gender:</label><br>
        <input type="radio" id="gender" name="gender" value="male" <?= ($gender == "male") ? "checked" : "" ?>>male<br>
        <input type="radio" id="gender" name="gender" value="female" <?= ($gender == "female") ? "checked" : "" ?>>female<br>
        <input type="radio" id="gender" name="gender" value="other" <?= ($gender == "other") ? "checked" : "" ?>>other<br>
        <span class="error"> * <?php echo $gender_error; ?></span>
        <br>

        <label for="role">Role:</label><br>
        <input type="radio" name="role" id="role" value="student" <?= ($role == "student") ? "checked" : "" ?>>student<br>
        <input type="radio" name="role" id="role" value="teacher" <?= ($role == "teacher") ? "checked" : "" ?>>teacher<br>
        <input type="radio" name="role" id="role" value="admin" <?= ($role == "admin") ? "checked" : "" ?>>admin<br>
        <span class="error"> * <?php echo $role_error; ?></span>
        <br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>"><br>
        <span class="error"> * <?php echo $username_error; ?></span>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?= htmlspecialchars($password) ?>"><br>
        <span class="error"> * <?php echo $password_error; ?></span>
        <br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
if (!$error) {
    $first_name = htmlspecialchars($first_name);
    $last_name = htmlspecialchars($last_name);
    $email = htmlspecialchars($email);
    $gender = htmlspecialchars($gender);
    $role = htmlspecialchars($role);
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    
    echo "<h1>SUBMITTED DATA</h1>";
    echo "<table border='1'>
            <tr><th>First Name</th><td>$first_name</td></tr>
            <tr><th>Last Name</th><td>$last_name</td></tr>
            <tr><th>Email</th><td>$email</td></tr>
            <tr><th>Gender</th><td>$gender</td></tr>
            <tr><th>Role</th><td>$role</td></tr>
            <tr><th>Username</th><td>$username</td></tr>
            <tr><th>Password</th><td>$password</td></tr>
          </table>";
}
?>
