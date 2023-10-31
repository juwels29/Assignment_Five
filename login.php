<?php
session_start();

include("bootstrap.php");

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

$errorMessage = "";


$fp = fopen("./data/users.txt", "r");

$roles = array();
$emails = array();
$firstnames = array();
$lastnames = array();
$ages = array();
$passwords = array();

while ($line = fgets($fp)) {
    $values = explode(",", $line);  // role, email, password, firstname, lastname, age

    array_push($roles, trim($values[0]));
    array_push($emails, trim($values[1]));
    array_push($passwords, trim($values[2]));
    array_push($firstnames, trim($values[3]));
    array_push($lastnames, trim($values[4]));
    array_push($ages, trim($values[5]));
}

fclose($fp);


for ($i = 0; $i < count($roles); $i++) {
    if ($email == $emails[$i] && $password == $passwords[$i]) {
        $_SESSION["role"] = $roles[$i];
        $_SESSION["email"] = $emails[$i];
        $_SESSION["firstname"] = $firstnames[$i];
        $_SESSION["lastname"] = $lastnames[$i];
        $_SESSION["age"] = $ages[$i];
        header("Location: index.php");
    }
    else {
        $errorMessage = "Wrong email or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
</head>
<body>
    
    <div class="container mt-5">
        <h1 class="text-center">Login to you account</h1>

        <form action="login.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="******">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>

        <p class="text-warning">
            <?php echo $errorMessage; ?>
        </p>
        <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>

</body>
</html>