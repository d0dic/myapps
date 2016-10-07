<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 07-Oct-16
 * Time: 4:42 PM
 */

namespace patterns\decorator;


class MathExam extends ExamDecorator
{

    /**
     * @return mixed
     */
    public function exams()
    {
        $this->student->exams();
        echo 'Math exam passed!<br/>';
    }
}