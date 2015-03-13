<?php

namespace application;

class Search
{


    public function __construct(Student $student)
    {
        $this->studentData = $student;
    }

    public function searchByNameCourseAndSpecialities()
    {
        $this->studentData->getName();
        $this->studentData->getCource();
        $this->studentData->getSpecialitie();
    }

    /**
     *
     * @return string SQL Return all student from Databese
     * @static
     */
    public static function getAllStudentForGrid()
    {

        return "SELECT STUDENT_ID,STUDENT_FNAME,STUDENT_LNAME, STUDENT_FNUMBER, STUDENT_EDUCATION_FORM, SPECIALITY_NAME_SHORT,
              COURSE_NAME, SA_STUDENT_ID,
              GROUP_CONCAT( SUBJECT_NAME ORDER BY SUBJECT_ID ) AS LISTOFSUBJECTS,
              GROUP_CONCAT( SA_ASSESMENT ORDER BY SUBJECT_ID ) AS LISTOFASSESSMENTS,
              GROUP_CONCAT( SA_WORKLOAD_LECTURES ORDER BY SUBJECT_ID ) AS LISTOF_SA_WORKLOAD_LECTURES,
              GROUP_CONCAT( SA_WORKLOAD_EXERCISES ORDER BY SUBJECT_ID ) AS LISTOF_SA_WORKLOAD_EXERCISES,
              GROUP_CONCAT( SUBJECT_WORKLOAD_LECTURES ORDER BY SUBJECT_ID ) AS LISTOF_SUBJECT_WORKLOAD_LECTURES,
              GROUP_CONCAT( SUBJECT_WORKLOAD_EXERCISES ORDER BY SUBJECT_ID ) AS LISTOF_SUBJECT_WORKLOAD_EXERCISES
            FROM students
                 LEFT JOIN specialities SP ON STUDENT_SPECIALITY_ID = SPECIALITY_ID
                 LEFT JOIN courses C ON C.COURSE_ID = STUDENT_COURSE_ID
                 LEFT JOIN students_assessments ON SA_STUDENT_ID = STUDENT_ID
                LEFT  JOIN subjects ON SUBJECT_ID = SA_SUBJECT_ID
              GROUP BY 1";
    }
    public static function studentSuggest($student_name)
    {
        return "select student_fname,student_lname from students where student_fname LIKE '$student_name%' limit 0,5";
    }

    public static function getAllSubjects()
    {
        return 'SELECT subject_id, subject_name FROM subjects ORDER BY subject_id ASC';
    }

    public static function getAllSpeciality()
    {
        return 'SELECT speciality_id ,speciality_name_long FROM specialities ORDER BY speciality_id ASC';
    }
    public static function getSpecialityById($id)
    {
        return  "SELECT speciality_id ,speciality_name_long FROM specialities WHERE speciality_id= {$id}";
    }

    public static function getAllCourses()
    {
        return 'SELECT course_id, course_name FROM courses ORDER BY course_id ASC';
    }

    /**
     * @param $studentName
     * @param int $subject
     * @param int $course
     * @return string
     */
    public static function searchStudent($studentName, $speciality = 0, $course = 0)
    {
        $studentName_clean = trim(htmlentities($studentName));
        $query_search_by_name = '';
        $studentName_clean_array = explode(' ', $studentName_clean);
        /**
         * validate and normalize student name
         */
        if(strlen( $studentName_clean)>0){
        foreach ($studentName_clean_array as $name) {
            if (strlen($name) > 0) {
                $studentName_fname_lname[] = trim($name);
            }
        }

        if (sizeof($studentName_fname_lname) == 1) {

            $query_search_by_name = "  STUDENT_FNAME LIKE '{$studentName_fname_lname[0]}%'";
        } elseif (sizeof($studentName_fname_lname) > 0) {

            $query_search_by_name = " STUDENT_FNAME LIKE '%{$studentName_fname_lname[0]}%'
                      AND
                       STUDENT_LNAME LIKE '{$studentName_fname_lname[1]}%'";
        }}
        /**
         * normalize search by course and speciality
         */

        if ($speciality ==0) {
            $speciality_search = null;
        } else if(strlen( $studentName_clean)>0){
            $speciality_search = 'AND speciality_id=' . $speciality;
        }
        else {
            $speciality_search = 'speciality_id=' . $speciality;
        }
        if ($course == 0) {
            $course_search = null;
        } else if(strlen( $studentName_clean)>0) {
            $course_search = 'AND course_id=' . $course;
        }
        else{
            $course_search = 'course_id=' . $course;
        }
        if($speciality>0 && $course>0){
            $speciality_search = 'speciality_id=' . $speciality.' AND ';
            $course_search = 'course_id=' . $course;
        }
        if(isset($studentName_fname_lname) && sizeof($studentName_fname_lname)>0 && $speciality>0 && $course>0 )
        {
            $speciality_search = 'AND speciality_id=' . $speciality.' AND ';
            $course_search = 'course_id=' . $course;

        }

        return "SELECT STUDENT_ID, STUDENT_FNAME,STUDENT_LNAME ,speciality_id,course_id,
                      STUDENT_FNUMBER, STUDENT_EDUCATION_FORM, SPECIALITY_NAME_SHORT,
                      COURSE_NAME, SA_STUDENT_ID,
                      GROUP_CONCAT( SUBJECT_NAME ORDER BY SUBJECT_ID ) AS LISTOFSUBJECTS,
                      GROUP_CONCAT( SA_ASSESMENT ORDER BY SUBJECT_ID ) AS LISTOFASSESSMENTS,
                      GROUP_CONCAT( SA_WORKLOAD_LECTURES ORDER BY SUBJECT_ID ) AS LISTOF_SA_WORKLOAD_LECTURES,
                      GROUP_CONCAT( SA_WORKLOAD_EXERCISES ORDER BY SUBJECT_ID ) AS LISTOF_SA_WORKLOAD_EXERCISES,
                      GROUP_CONCAT( SUBJECT_WORKLOAD_LECTURES ORDER BY SUBJECT_ID ) AS LISTOF_SUBJECT_WORKLOAD_LECTURES,
                      GROUP_CONCAT( SUBJECT_WORKLOAD_EXERCISES ORDER BY SUBJECT_ID ) AS LISTOF_SUBJECT_WORKLOAD_EXERCISES
                FROM students
                    left  JOIN specialities SP ON STUDENT_SPECIALITY_ID = SPECIALITY_ID
                    left  JOIN courses C ON C.COURSE_ID = STUDENT_COURSE_ID
                    left  JOIN students_assessments ON SA_STUDENT_ID = STUDENT_ID
                    left  JOIN subjects ON SUBJECT_ID = SA_SUBJECT_ID
                      WHERE
                        {$query_search_by_name}

                        {$speciality_search}
                        {$course_search}
                GROUP BY 1

	";
    }

}
