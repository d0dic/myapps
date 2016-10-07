<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 07-Oct-16
 * Time: 4:26 PM
 */

namespace patterns\decorator;

/**
 * Class LawStudent
 * @package decorator
 */
class LawStudent implements Student
{
    /**
     * @return mixed
     */
    public function exams()
    {
        echo 'Passed exams: <br/>';
    }
}