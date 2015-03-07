<?php
//session_start();
include 'before.html';
include 'application/config/autoloader.php';
$connect = application\Connect::getInstance();
//echo '<pre>'.print_r($_SERVER,true).'</pre>';


if (isset($_GET['hidden']) == 1) {

    $query = application\Search::searchStudent($_GET['student_name']);
    $_SESSION['search_query'] = "student_name={$_GET['student_name']}&searchBySubject=1&searchByCourse=1";
    $_SESSION['search_by_name'] = htmlentities($_GET['student_name']);

} else {
    if (isset($_GET['student_name'])) {
        $query = application\Search::searchStudent($_GET['student_name']);
    } else {
        unset($_SESSION['search_query']);
        unset($_SESSION['search_by_name']);
        $query = application\Search::getAllStudentForGrid();
    }

}
echo $query;


$allSubject = $connect->query(application\Search::getAllSubjects());

$allCourses = $connect->query(application\Search::getAllCourses());
$num_subject = $allSubject->rowCount();


?>
<form action="" method="get">
    <input type="text" name="student_name"
           value="<?php if (!empty($_SESSION['search_by_name'])): echo $_SESSION['search_by_name']; endif; ?>"/><br>

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
        <input type="hidden" name="hidden" value="1"/>
        <input type="submit" value="Търсене" name="search"/>
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


//$studentGridQuery = application\Search::getAllStudentForGrid();
$search_query = null;
if (isset($_SESSION['search_query'])) {
    $search_query = $_SESSION['search_query'];
}
$paginator = new \application\Paginator($connect, $query, $search_query);

$pagin_result = $paginator->pagination();
$grid = new application\StudentTable();
foreach ($allSubject as $row) {
    echo "<td colspan='3'>" . $row['subject_name'] . "</td>";
}
$grid->createTable($pagin_result, $connect->query(application\Search::getAllSubjects()), $num_subject);
$paginator->links();
?>

</div>
</body>
</html>
