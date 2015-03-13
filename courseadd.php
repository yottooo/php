<?php include "before.php" ?>
    <p>Добавяне на Курс<br>
    <form action="" method="POST">
       Име на Курс:<input type="text" name="kurs-ime" ><br>
     <button type="reset">Откажи</button><button type="submit">Добави</button>
    </form>
    </body>
</html>
           <?php
if ('post' === strtolower($_SERVER['REQUEST_METHOD'])) {
                    if (!($stmt = $mysqli->prepare("INSERT INTO courses(course_name) VALUES(?)"))) {
                        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                    }

                        if (!$stmt->bind_param("s", $_POST["kurs-ime"])) {
                            echo "Binding parameters failed: (" . $stmt1->errno . ") " . $stmt1->error;
                        }
                        if ($stmt->execute()){ echo "Записа беше успешен :)";}    
}
?>
