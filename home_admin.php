<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
}
include"bootstrap.php";


// Niche user der data txt file theke collect korbo ar sheta onek gula data dekhe array te rakhbo

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

// Upore shobar data neya hoise file theke akhon sheta akta array te rakhbo
for ($i = 0; $i < count($roles); $i++) {
	$all_data[] = array('role' => $roles[$i], 'email'=>$emails[$i], 'firstname'=>$firstnames[$i], 'lastname'=>$lastnames[$i], 'age'=>$ages[$i]);
}
// one by one serial a jabe
$serial = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <h1>Admin panel</h1>
    <h1>Welcome! <?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"];  ?></h1>
    <h2>Role: <?php echo $_SESSION["role"];  ?></h1>
    
    <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">No.</th>
	  <th scope="col">Role</th>
	  <th scope="col">Email</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Age</th>
    </tr>
  </thead>
  <tbody>
    <!-- Niche foreach loop diye shobar data show korbo -->
    <?php foreach ($all_data as $item): ?>
	<tr>
		<td><?php echo ++$serial; ?></td>
		<td><?php echo $item['role'] ?></td>
		<td><?php echo $item['email'] ?></td>
		<td><?php echo $item['firstname'] ?></td>
		<td><?php echo $item['lastname'] ?></td>
		<td><?php echo $item['age'] ?></td>
	</tr>
	<?php endforeach; ?>
  </tbody>
</table>



    <hr></hr>
    <a href="logout.php">Logout</a>

</body>
</html>