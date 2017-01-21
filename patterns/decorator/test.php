<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 07-Oct-16
 * Time: 4:46 PM
 */

use patterns\decorator\LawExam;
use patterns\decorator\MathExam;
use patterns\decorator\LawStudent;
use patterns\decorator\HistoryExam;

$student = new LawStudent();
$student = new LawExam($student);
$student = new MathExam($student);
$student = new HistoryExam($student);

$student->exams();

structurePreview(__DIR__);