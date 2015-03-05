<?php include 'before.html';?>
    <p>Добавяне на Специалност<br>
    <form action="" method="POST">
       Име:<input type="text" name="spec-ime" ><br>
       Абревиатура:<input type="text" name="spec-abr" ><br>
        <button type="reset">Откажи</button><button type="submit">Добави</button>
    </form>
    </body>
</html>
           <?php
           $mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8'); 
                    if (!($stmt = $mysqli->prepare("INSERT INTO specialities(speciality_name_long,speciality_name_short) VALUES(?,?)"))) {
                        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                    }

                        if (!$stmt->bind_param("ss", $_POST["spec-ime"],$_POST["spec-abr"])) {
                            echo "Binding parameters failed: (" . $stmt1->errno . ") " . $stmt1->error;
                        }
                        if ($stmt->execute()){ echo "Записа беше успешен :)";}       
?>