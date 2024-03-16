<?php
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$dob = $_POST['dob'];

if (!empty($name) || !empty($email) || !empty($age) || !empty($dob)) {
	$db = new mysqli('demoDB.db');

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
	die('Connect Error('. mysqli_connect_errno() .') '. mysqli_connect_error());
}else {
	$SELECT = "SELECT email From register Where email = ? Limit 1";
	$INSERT = "INSERT Into register (name, email, age, dob) values(?, ?, ?, ?)";

	$stmt = $conn->prepare($SELECT);
	$stmt ->bind_param("s", $email);
	$stmt ->execute();
		$stmt ->bind_result($email);
		$stmt ->bind_result();
		$rnum = $stmt ->num_rows;

if ($rnum==0) {
	$stmt->close();
	$stmt = $conn->prepare($INSERT);
	$stmt->bind_param("ssid", $name, $email, $age, $dob);
	$stmt->execute();
	echo "New record inserted sucessfully";
}else {
	echo "Someone already register using this email";
}
$stmt->close();
$conn->close();
}
}else  {
	echo "All field are required";
	die();
}
?>