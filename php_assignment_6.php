<?php
$first_name = $last_name = $dob = $address = $mobile = $email = "";
$first_error = $last_error = $dob_error = $address_error = $mob_error =$email_error ="";
$error=false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING);
    if (empty($first_name)) {
        $first_error = "First Name is required.";
        $error=true;
    }

    $last_name = filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING);
    if (empty($last_name)) {
        $last_error = "Last Name is required.";
        $error=true;

    }

    $dob =filter_var( trim($_POST['dob']), FILTER_SANITIZE_NUMBER_INT);
    if (empty($dob)) {
        $dob_error= "Date of Birth is required.";
        $error=true;

    } 

    $address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
    if (empty($address)) {
        $address_error = "Address is required.";
        $error=true;

    }

    $mobile = filter_var(trim($_POST['mobile']), FILTER_SANITIZE_NUMBER_INT);
    if (empty($mobile)) {
        $mob_error = "Mobile Number is required.";
        $error=true;

    } 
    elseif (!preg_match("/^\d{11}$/", $mobile)) {
        $mob_error = "Mobile Number must be exactly 11 digits.";
        $error=true;

    }

    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    if (empty($email)) {
        $email_error = "Email is required.";
        $error=true;

    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format.";
        $error=true;

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <style>
        .error{
            color:red;
        }
        .form{
            margin: 100px 500px;
            width: 350px;
            height:400px;
            border: 2px solid;
            box-shadow: 2px 2px 20px blanchedalmond;
            background-color:rgb(225, 236, 219);
            padding-left: 20px;
            padding-top: 30px;
            font-size: 18px;
        }
        table{
            margin: 100px 500px;
            width: 400px;
            height: 500px;
            border: 2px solid;
            box-shadow: 2px 2px 20px blanchedalmond;
            background-color:rgb(225, 236, 219);
            font-size: 18px;
        }
        h1{
            margin:0px 450px;
            
        }
    </style>
</head>
<body>
    <h1>STUDENT'S REGISTRATION FORM</h1>
    <form class=" form" action="php_assignment_6.php" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($first_name) ?>"><br>
        <span class="error"> * <?php echo $first_error; ?></span>
        <br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($last_name) ?>"><br>
        <span class="error"> * <?php echo $last_error; ?></span>
        <br>

        <label for="dob">Date of Birth (YYYY-MM-DD):</label>
        <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($dob) ?>"><br>
        <span class="error"> * <?php echo $dob_error; ?></span>
        <br>

        <label for="address">Address:</label>
        <textarea id="address" name="address"><?= htmlspecialchars($address) ?></textarea><br>
        <span class="error"> * <?php echo $address_error; ?></span>
        <br>

        <label for="mobile">Mobile Number:</label>
        <input type="text" id="mobile" name="mobile" value="<?= htmlspecialchars($mobile) ?>"><br>
        <span class="error"> * <?php echo $mob_error; ?></span>
        <br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($email) ?>"><br>
        <span class="error"> * <?php echo $email_error; ?></span>
        <br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php
     if(!$error){
        $first_name = htmlspecialchars($first_name);
        $last_name = htmlspecialchars($last_name);
        $dob = htmlspecialchars($dob);
        $address = htmlspecialchars($address);
        $mobile = htmlspecialchars($mobile);
        $email = htmlspecialchars($email);
        
        echo "<h1>SUBMITTED STUDENT'S DATA</h1>";
        echo "<table border='1'>
                <tr><th>First Name</th><td>$first_name</td></tr>
                <tr><th>Last Name</th><td>$last_name</td></tr>
                <tr><th>Date of Birth</th><td>$dob</td></tr>
                <tr><th>Address</th><td>$address</td></tr>
                <tr><th>Mobile</th><td>$mobile</td></tr>
                <tr><th>Email</th><td>$email</td></tr>
              </table>";
    }
?>
