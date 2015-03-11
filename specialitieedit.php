<?php include 'before.php';?>
    <p>Редактиране на Специалност<br>
    <form action="" method="post">
       Име:<input type="text" name="spec-ime" ><br>
       Абревиатура:<input type="text" name="spec-abr" ><br>
        <button type="reset">Откажи</button><button type="submit">Редактирай</button>
    </form>
    </body>
</html>
          <?php
           
    if ('post' === strtolower($_SERVER['REQUEST_METHOD'])) {
        


        var_dump($mysqli->query("UPDATE specialities SET speciality_name_long='".$_POST['spec-ime']."', speciality_name_short='".$_POST['spec-abr']."' WHERE speciality_id=".$_REQUEST['edit_id']));      
        $mysqli->close();
        
        header('Location: specialities.php');
    }       
?>