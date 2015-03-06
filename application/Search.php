<?php

namespace application;

class Search {

    private $studentData;

    public function __construct(Student $student) {
        $this->studentData = $student;
    }

    public function searchByNameCourseAndSpecialities() {
        $this->studentData->getName();
        $this->studentData->getCource();
        $this->studentData->getSpecialitie();
    }

    /**
     *
     * @return string SQL Return all student from Databese
     * @static
     */
    public static function getAllStudentForGrid() {
        return "SELECT STUDENT_ID, STUDENT_FNAME, STUDENT_LNAME, STUDENT_FNUMBER, STUDENT_EDUCATION_FORM, SPECIALITY_NAME_SHORT,
              COURSE_NAME, SA_STUDENT_ID,
              GROUP_CONCAT( SUBJECT_NAME ORDER BY SUBJECT_ID ) AS LISTOFSUBJECTS,
              GROUP_CONCAT( SA_ASSESMENT ORDER BY SUBJECT_ID ) AS LISTOFASSESSMENTS,
              GROUP_CONCAT( SA_WORKLOAD_LECTURES ORDER BY SUBJECT_ID ) AS LISTOF_SA_WORKLOAD_LECTURES,
              GROUP_CONCAT( SA_WORKLOAD_EXERCISES ORDER BY SUBJECT_ID ) AS LISTOF_SA_WORKLOAD_EXERCISES,
              GROUP_CONCAT( SUBJECT_WORKLOAD_LECTURES ORDER BY SUBJECT_ID ) AS LISTOF_SUBJECT_WORKLOAD_LECTURES,
              GROUP_CONCAT( SUBJECT_WORKLOAD_EXERCISES ORDER BY SUBJECT_ID ) AS LISTOF_SUBJECT_WORKLOAD_EXERCISES
            FROM students
                  JOIN specialities SP ON STUDENT_SPECIALITY_ID = SPECIALITY_ID
                  JOIN courses C ON C.COURSE_ID = STUDENT_COURSE_ID
                  JOIN students_assessments ON SA_STUDENT_ID = STUDENT_ID
                  JOIN subjects ON SUBJECT_ID = SA_SUBJECT_ID
              GROUP BY 1";
    }

    public static function getAllSubjects() {
        return 'SELECT subject_id, subject_name FROM subjects ORDER BY subject_id ASC';
    }

    public static function getAllCourses() {
        return 'SELECT course_id, course_name FROM courses ORDER BY course_id ASC';
    }

    public static function searchStudent($studentName, $subject=1, $course=1) {
        $studentName_clean = htmlentities($studentName);
        return "SELECT STUDENT_ID, STUDENT_FNAME, STUDENT_LNAME, STUDENT_FNUMBER, STUDENT_EDUCATION_FORM, SPECIALITY_NAME_SHORT,
              COURSE_NAME, SA_STUDENT_ID,
              GROUP_CONCAT( SUBJECT_NAME ORDER BY SUBJECT_ID ) AS LISTOFSUBJECTS,
              GROUP_CONCAT( SA_ASSESMENT ORDER BY SUBJECT_ID ) AS LISTOFASSESSMENTS,
              GROUP_CONCAT( SA_WORKLOAD_LECTURES ORDER BY SUBJECT_ID ) AS LISTOF_SA_WORKLOAD_LECTURES,
              GROUP_CONCAT( SA_WORKLOAD_EXERCISES ORDER BY SUBJECT_ID ) AS LISTOF_SA_WORKLOAD_EXERCISES,
              GROUP_CONCAT( SUBJECT_WORKLOAD_LECTURES ORDER BY SUBJECT_ID ) AS LISTOF_SUBJECT_WORKLOAD_LECTURES,
              GROUP_CONCAT( SUBJECT_WORKLOAD_EXERCISES ORDER BY SUBJECT_ID ) AS LISTOF_SUBJECT_WORKLOAD_EXERCISES
            FROM students
                  JOIN specialities SP ON STUDENT_SPECIALITY_ID = SPECIALITY_ID
                  JOIN courses C ON C.COURSE_ID = STUDENT_COURSE_ID
                  JOIN students_assessments ON SA_STUDENT_ID = STUDENT_ID
                   JOIN subjects ON SUBJECT_ID = SA_SUBJECT_ID
    WHERE  STUDENT_FNAME LIKE '%{$studentName_clean}%'
              GROUP BY 1";
    }

}
