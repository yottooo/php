<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();
$mysqli = new mysqli('localhost', 'root', 'qwerty', 'students');
$mysqli->set_charset('utf8');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /s>
<title>Untitled Document</title>
<link href="inc/cool.css" rel="stylesheet" type="text/css" />
<link href="inc/paginator.css" rel="stylesheet" type="text/css" />
<script>
function edituser(num)
{

   if (confirm("Редактиране на данни за Потребителя!?"))
     self.location.href="useredit.php?edit_id="+num;
}  </script>
</head>
<body>
<center><ul>
<li><a href="index.php">Начало</a></li>
      <?php
if (isset($_SESSION["user_name"]))
{?>
<li><a href="coursess.php">Курсове</a></li>
<li><a href="specialities.php">Специалности</a></li>
<li><a href="discipline.php">Дисциплини</a></li>
<li><a href="students.php">Студенти</a></li>
<li><a href="Ases.php">Оценки</a></li>
<li><a href="users.php">Потребители</a></li>&nbsp;
    <li>
     <?php }   ?>
      <?php
if (!isset($_SESSION["user_name"]))
{?><a href="useradd.php">Регистрация</a>&nbsp;
      <form action="login.php" method="post">
        <pre>Потребител:    Парола:              </pre>
        <input type="text" name="user_name"  />
        <input type="password" name="user_password"  />
        <input type="submit" value="Вход" />
        &nbsp;
      </form>
      <?php }
else echo $_SESSION["user_name"]." ".$_SESSION["user_lname"]." ". "<a href='logout.php'>Изход</a>&nbsp;";
?>
    </li>
</ul></center>

