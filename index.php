
<?php
include 'before.php';
include 'application/config/autoloader.php';
  
$connect = application\Connect::getInstance();


if (isset($_GET['hidden']) == 1) {
    if(empty($_GET['student_name'])  && $_GET['searchBySpeciality']==0 && $_GET['searchByCourse']==0){
        unset($_SESSION['search_query']);
        unset($_SESSION['search_by_name']);
        unset( $_SESSION['search_by_speciality']);
        unset($_SESSION['search_by_course']);
        $query = application\Search::getAllStudentForGrid();
    }else{
        $query = application\Search::searchStudent($_GET['student_name'],$_GET['searchBySpeciality'],$_GET['searchByCourse']);
        $_SESSION['search_query'] = "student_name={$_GET['student_name']}&searchBySpeciality={$_GET['searchBySpeciality']}
        &searchByCourse={$_GET['searchByCourse']}";
        $_SESSION['search_by_name'] = htmlentities($_GET['student_name']);
        $_SESSION['search_by_speciality']=$_GET['searchBySpeciality'];
        $_SESSION['search_by_course']=$_GET['searchByCourse'];

    }


} else {
    if (isset($_GET['student_name'])) {
        $query = application\Search::searchStudent($_GET['student_name'],$_GET['searchBySpeciality'],$_GET['searchByCourse']);
    } else {
        unset($_SESSION['search_query']);
        unset($_SESSION['search_by_name']);
        unset( $_SESSION['search_by_speciality']);
        unset($_SESSION['search_by_course']);
        $query = application\Search::getAllStudentForGrid();
    }

}
//echo $query;


$allSubject = $connect->query(application\Search::getAllSubjects());
$allSpeciality = $connect->query(\application\Search::getAllSpeciality());
$allCourses = $connect->query(application\Search::getAllCourses());
$num_subject = $allSubject->rowCount();


?>
<div class="wrapper">
<form action="" method="get">
    <fieldset class="search_field">
        <legend>Търсене на студент</legend>
        <div class="input_container">
    <input type="text" name="student_name" placeholder="Име На студента" id="book" onkeyup="showHint(this.value)"
           value="<?php if (!empty($_SESSION['search_by_name'])): echo $_SESSION['search_by_name']; endif; ?>" autocomplete="off"/>
        <ul id="suggestion" ></ul>
            </div>

    <div>
        <p>Специалност</p>
        <select name="searchBySpeciality">
            <option value="0">Всички</option>
            <?php foreach ($allSpeciality as $speciality): ?>
                <option value="<?= $speciality['speciality_id']; ?>"
                    <?php if( isset($_SESSION['search_by_speciality']) &&
                        $_SESSION['search_by_speciality']==$speciality['speciality_id'] ){echo "selected";}?>>
                    <?= $speciality['speciality_name_long']; ?></option>
            <?php endforeach; ?>
        </select>
        <label><p>Курс</p></label>
        <select name="searchByCourse">
            <option value="0" selected >Всички</option>
            <?php foreach ($allCourses as $course): ?>
                <option value="<?= $course['course_id']; ?>"
                    <?php if( isset($_SESSION['search_by_course']) &&
                        $_SESSION['search_by_course']==$course['course_id'] ){echo "selected";}?>
                    ><?= $course['course_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="hidden" name="hidden" value="1"/>
        <br>
        <input type="submit" value="Търсене" name="search"/>
    </div>
        </fieldset>
</form>

<section class="grid" >
    <?php
    $search_query = null;
    if (isset($_SESSION['search_query'])) {
        $search_query = $_SESSION['search_query'];
    }
    $paginator = new \application\Paginator($connect, $query, $search_query);
   
    $pagin_result = $paginator->pagination();
   
    $grid = new application\StudentTable();

    $grid->createTable($pagin_result, $connect->query(application\Search::getAllSubjects()), $num_subject);

    ?>
    <div class="pagi"><?php echo $paginator->links();
  
    ?></div>
</section>

</div>
<script type="text/javascript">
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("book").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("suggestion").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "student-suggestion.php?q=" + str, true);
            xmlhttp.send();
        }
    }

    function set_item(item) {
        // change input value
        $('#book').val(item);
        // hide proposition list
        $('#suggestion').hide();
    }
</script>

</body>
</div>
</body>
</html>
