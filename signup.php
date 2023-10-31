<?php

include("bootstrap.php");

$firstname = $_POST["firstname"] ?? "";
$lastname = $_POST["lastname"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? ""; 
$age = $_POST["age"] ?? ""; 

$role = "user";

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
	$all_data[] = array('role' => $roles[$i], 'email'=>$emails[$i], 'firstname'=>$firstnames[$i], 'lastname'=>$lastnames[$i], 'age'=>$ages[$i]);
}

foreach ($all_data as $item):
    $emails= $item['email'];

endforeach;

if ($email != $emails){

        if ($email != "" && $password != "") {  
            $fp = fopen("./data/users.txt", "a");
            
            fwrite($fp, "\n{$role}, {$email}, {$password}, {$firstname}, {$lastname}, {$age}");
            fclose($fp);
    
            header("Location: login.php");
        }
        else {
            $errorMessage = "Please enter your email and password!";
        }
}
else {
    $errorMessage = "Email already exits!";
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
        <h1 class="text-center">Create a new account</h1>

        <form action="signup.php" method="POST">

        <div class="form-group">
            <label for="firstname">First name</label>
            <input type="text" class="form-control" name="firstname" id="firstname"  placeholder="Enter firstname" required >
            
        </div>

        <div class="form-group">
            <label for="lastname">Last name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter lastname" required>
            
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control" name="age" id="age" placeholder="Enter your age" required>
            
        </div>

        <div class="form-group">
            <label for="email">Password</label>
            <input type="password" class="form-control" name="password" id="email" placeholder="******" required>
        </div>

        <p class="text-danger">
            <?php echo $errorMessage; ?>
        </p>


        <button type="submit" class="btn btn-warning">Sign up</button>
        </form>
    </div>

   </body>
</html>