<?php include "before.php" ?>
    <p>Редактиране на Потребител<br>
    <form action="" method="post">
      Потребителско Име:<input type="text" name="user-ime" ><br>
      Собствено Име:<input type="text" name="user-sime" ><br>
      Фамилно Име:<input type="text" name="user-fime" ><br>
      Парола:<input type="text" name="user-pass" ><br>
      Парола:<input type="text" name="user-pass2" ><br>
      E-mail:<input type="text" name="user-mail" ><br>
        <button type="reset">Откажи</button><button type="submit">Редактирай</button>
    </form>
    </body>
</html>
          <?php
           
    if ('post' === strtolower($_SERVER['REQUEST_METHOD'])) {
        


        var_dump($mysqli->query("UPDATE users SET user_name='".$_POST['user-ime']."', user_fname='".$_POST['user-sime']."', user_lname='".$_POST['user-fime']."', user_email='".$_POST['user-mail']."', user_password='".$_POST['user-pass']."' WHERE user_id=".$_REQUEST['edit_id']));      
        $mysqli->close();
        
        header('Location: users.php');
    }       
?>