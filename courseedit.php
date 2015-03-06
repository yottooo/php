<?php include 'before.html';?>
    <p>Редактиране на Курс<br>
    <form action="" method="post" >
       Име на Курс:<input type="text" name="kurs-ime" ><br>
     <button type="reset">Откажи</button><button type="submit">Редактирай</button>
    </form>
    </body>
</html>
           <?php
           
    if ('post' === strtolower($_SERVER['REQUEST_METHOD'])) {
        
        $mysqli = new mysqli('localhost', 'root', '', 'students');
        $mysqli->set_charset('utf8'); 

        $mysqli->query("UPDATE courses SET course_name='".$_POST['kurs-ime']."' WHERE course_id=".$_REQUEST['edit_id']);      
        $mysqli->close();
        
        header('Location: coursess.php');
    }       
?>