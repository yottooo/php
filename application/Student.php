<?php

namespace application;

class Student
{

    private $courses;
    private $specialities;
    private $name;

    public function __construct(/* $name,$course,$specialitie */)
    {
        /* $this->name = $name;
          $this->courses = $course;
          $this->specialities = $specialitie; */
    }

    /**
     * validate input name from form
     */
    public function setName($studentName)
    {
        $this->name = $studentName;
    }

    public function getName()
    {
        echo $this->name . '->valid<br>';
    }

    /**
     *
     * @param Course $studentCourse
     */
    public function setCourse($studentCourse)
    {
        $this->courses = $studentCourse;
    }

    public function getCource()
    {
        $this->courses->getName();
    }

    /**
     *
     * @param Specialitie $studentSpecialtie
     */
    public function setSpecialitie($studentSpecialtie)
    {
        $this->specialities = $studentSpecialtie;
    }

    public function getSpecialitie($long = true)
    {
        $this->specialities->getName($long);
    }

    public static function add()
    {
        //todo add student validation
    }

}
