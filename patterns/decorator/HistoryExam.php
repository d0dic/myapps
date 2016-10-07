<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 07-Oct-16
 * Time: 5:02 PM
 */

namespace patterns\decorator;

/**
 * Class HistoryExam
 * @package patterns\decorator
 */
class HistoryExam extends ExamDecorator
{

    /**
     * @return mixed
     */
    public function exams()
    {
        $this->student->exams();
        echo 'History exam passed!<br/>';
    }

}