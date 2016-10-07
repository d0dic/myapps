<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 07-Oct-16
 * Time: 4:45 PM
 */

namespace patterns\decorator;


class LawExam extends ExamDecorator
{

    /**
     * @return mixed
     */
    public function exams()
    {
        $this->student->exams();
        echo 'Law exam passed!<br/>';
    }
}