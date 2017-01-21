<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 11:53 AM
 */

namespace app\classes\builders;
use app\classes\applications\FbApplication;

/**
 * Class QuestionnaireBuilder
 * @package app\classes
 */
class QueryAppBuilder extends FbAppBuilder
{
    function createApp()
    {
        $this->app = new FbApplication('query');
    }

    function buildModels()
    {
        $this->app->setModels([
            'Form.php', 'Question.php', 'Answer.php', 'Reply.php'
        ]);
    }

    function buildControllers()
    {
        $this->app->setControllers([
            'QuestionController.php'
        ]);
    }
    
    function buildComponents()
    {
        $this->app->setComponents([
            'FacebookComponent.php'
        ]);
    }

    function buildMigrations()
    {
//        $this->app->setMigrations([
//            'm160831_120313_form.php', 'm160831_120347_question.php',
//            'm160831_120355_answer.php', 'm160902_112903_reply.php'
//        ]);
    }

    function buildViews()
    {
        $this->app->setViews([
            'question' // view folders only
        ]);
    }
}