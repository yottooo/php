<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include "before.html" ?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <a href="useradd.html">Добавяне на Потребител</a><br>
    <form action="">
      Потребителско Име:<input type="text" name="user-ime" ><br>
      E-mail:<input type="text" name="user-mail" ><br>
    <button type="submit">Търси</button>
    </form><br>
    <table width="200" border="1">
  <tr>
    <th >#</th>
        <th >Потребителско Име</th>
    <th >Email</th>
    <th >Операции</th>
  </tr>
      <?php
    $mysqli = new mysqli('localhost', 'root', '', 'students'); 
$mysqli->set_charset('utf8'); 
if($_GET["user-ime"]=="" || $_GET["user-mail"]==""){
if($_GET["user-mail"]==""){$result = $mysqli->query("SELECT * FROM users where user_name='". $_GET["user-ime"] ."'");}
else if($_GET["user-ime"]=="" ){$result = $mysqli->query("SELECT * FROM users where user_email='". $_GET["user-mail"] ."'");}
} else
if($_GET["user-ime"]!="" && $_GET["user-mail"]!=""){"SELECT FROM users where user_email='". $_GET["user-mail"] ."' and user_name='". $_GET["user-ime"] ."'";}
    else{$result = $mysqli->query("SELECT * FROM users ");}
$mysqli->close();
while ($row=$result->fetch_assoc())
{
    echo "<tr><th>".$row["user_id"]."</th>"."<th>".$row["user_name"]."</th><th>".$row["user_email"]."<th><a >DEL</a>"." "."<a>Редакция </a></th>";
}
            ;
    ?>
</table>

    </body>
</html>
