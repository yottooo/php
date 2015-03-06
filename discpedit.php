<?php include 'before.html';?>
    <p>Редактиране на Дисциплина<br>
    <form action="" method="post">
       Име:<input type="text" name="disc-ime" ><br>
       Хорариум(Л):<input type="text" name="disc-L" ><br>
      Хорариум(У): <input type="text" name="disc-U" ><br>
       <button type="reset">Откажи</button><button type="submit">Редактирай</button>
    </form>
    </body>
</html>
          <?php
           
    if ('post' === strtolower($_SERVER['REQUEST_METHOD'])) {
        
        $mysqli = new mysqli('localhost', 'root', '', 'students');
        $mysqli->set_charset('utf8'); 

        var_dump($mysqli->query("UPDATE subjects SET subject_name='".$_POST['disc-ime']."', subject_workload_lectures='".$_POST['disc-L']."', subject_workload_exercises='".$_POST['disc-U']."' WHERE subject_id=".$_REQUEST['edit_id']));      
        $mysqli->close();
        
        header('Location: discipline.php');
    }       
?>