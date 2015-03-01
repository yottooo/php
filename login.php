<?php session_start(); ?>
<?php
$mysqli = new mysqli('localhost', 'root', '', 'students'); 
$mysqli->set_charset('utf8'); 

$result = $mysqli->query("SELECT * FROM users where user_name='". $_POST["user_name"] . "' and user_password='" . $_POST["user_password"] . "'");

$mysqli->close();

if ($row = $result->fetch_assoc())
{
	$_SESSION["user_name"]=htmlspecialchars(stripslashes($row["user_name"]));
	$_SESSION["user_lname"]=htmlspecialchars(stripslashes($row["user_lname"]));
}
else $_SESSION["error"]="Невалидно потребителско име или грешна парола!";

header("Location: .");
exit;

?>
