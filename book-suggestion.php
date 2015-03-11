<?php  
$mysqli = new mysqli('localhost', 'root', '', 'students'); 
$mysqli->set_charset('utf8');

$book_name = $_POST['book_name'];  
$sql = "select student_fname from students where student_fname LIKE '$book_name%'";  
$result = $mysqli->query($sql);  
while($row=  mysqli_fetch_array($result))  
{  
echo "<p>".$row['student_fname']."</p>";  
}  
 