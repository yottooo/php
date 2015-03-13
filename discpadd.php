<?php include 'before.php';?>
    <p>Добавяне на Дисциплина<br>
    <form action="" method="POST">
       Име:<input type="text" name="disc-ime" ><br>
       Хорариум(Л):<input type="text" name="disc-L" ><br>
      Хорариум(У): <input type="text" name="disc-U" ><br>
       <button type="reset">Откажи</button><button type="submit">Добави</button>
    </form>
    </body>
</html>
           <?php
 if ('post' === strtolower($_SERVER['REQUEST_METHOD'])) {
                    if (!($stmt = $mysqli->prepare("INSERT INTO subjects(subject_name,subject_workload_lectures,subject_workload_exercises) VALUES(?,?,?)"))) {
                        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                    }

                        if (!$stmt->bind_param("sii", $_POST["disc-ime"],$_POST["disc-L"],$_POST["disc-U"])) {
                            echo "Binding parameters failed: (" . $stmt1->errno . ") " . $stmt1->error;
                        }
                        if ($stmt->execute()){ echo "Записа беше успешен :)";}       
 }
?>