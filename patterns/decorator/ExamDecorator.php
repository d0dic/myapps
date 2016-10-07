<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 07-Oct-16
 * Time: 4:28 PM
 */

namespace patterns\decorator;

/**
 * Class LawStudentDecorator
 * @package decorator
 */
abstract class ExamDecorator implements Student
{
    /**
     * @var Student
     */
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }
}