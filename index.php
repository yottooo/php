<?php
include 'before.html';
include 'application/config/autoloader.php';
$connect = application\Connect::getInstance();
if(isset($_GET['search'])==true){
  $query = application\Search::searchStudent($_GET['student_name']);
}else{
    $query = application\Search::getAllStudentForGrid();
}
echo $query;
//$studentGrid = $connect->query($query);
$allSubject = $connect->query(application\Search::getAllSubjects());
$allCourses = $connect->query(application\Search::getAllCourses());
$num_subject = $allSubject->rowCount();


?>
<form action="" method="get" >
    <input type="text" name="student_name" /><br>
    <div>
        <select name="searchBySubject">
            <?php foreach ($allSubject as $subject): ?>
                <option value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <select name="searchByCourse">
            <?php foreach ($allCourses as $course): ?>
                <option value="<?= $course['course_id']; ?>"><?= $course['course_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="submit" value="Търсене" name="search" />
    </div>
</form>
<?php
//searching student

/*
  $student = application\StudentFactory::createStudent();
  $student->setName('Иван Божаков');
  $student->setCourse(new application\Course('peti'));
  $student->setSpecialitie(new application\Specialitie());


  $studentSearch = \application\StudentFactory::search($student);

 */



$studentGridQuery = application\Search::getAllStudentForGrid();

$paginator = new \application\Paginator($connect, $studentGridQuery);

$pagin_result = $paginator->pagination();
$grid = new application\StudentTable();
$grid->createTable($pagin_result, $allSubject, $num_subject);
$paginator->links();
?>

</div>
</body>
</html>
