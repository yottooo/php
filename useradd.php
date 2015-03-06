<?php include "before.html" ?>
    <p>Добавяне на Потребител<br>
    <form action="" method="POST">
      Потребителско Име:<input type="text" name="user-ime" ><br>
      Собствено Име:<input type="text" name="user-sime" ><br>
      Фамилно Име:<input type="text" name="user-fime" ><br>
      Парола:<input type="password" name="user-pass" ><br>
      Парола:<input type="password" name="user-pass2" ><br>
      E-mail:<input type="text" name="user-mail" ><br>
        <button type="reset">Откажи</button><button type="submit">Добави</button>
    </form>
    </body>
</html>
           <?php
           $mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8'); 
                    if (!($stmt = $mysqli->prepare("INSERT INTO users(user_name,user_fname,user_lname,user_password,user_email) VALUES(?,?,?,?,?)"))) {
                        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                    }

                        if (!$stmt->bind_param("sssss", $_POST["user-ime"],$_POST["user-sime"],$_POST["user-fime"],$_POST["user-pass"],$_POST["user-mail"])) {
                            echo "Binding parameters failed: (" . $stmt1->errno . ") ";
                        } 
                        if ($stmt->execute()){ echo "Записа беше успешен :)";}       
?>