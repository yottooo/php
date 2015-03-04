<?php include 'before.html';?>
    <p>Редактиране на Курс<br>
    <form action="" mehod="POST" >
       Име на Курс:<input type="text" name="kurs-ime" ><br>
     <button type="reset">Откажи</button><button type="submit">Редактирай</button>
    </form>
    </body>
</html>
           <?php
           var_dump($_REQUEST['edit_id']);
           $mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8'); 

$mysqli->query("UPDATE courses SET course_name=".$_POST['kurs-ime']." WHERE course_id=".$_REQUEST['edit_id']);      
        $mysqli->close();
?>