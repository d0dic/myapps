<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 11:53 AM
 */

namespace app\classes;

/**
 * Class QuestionnaireBuilder
 * @package app\classes
 */
class QuestionnaireBuilder extends AppBuilder
{
    function createApp()
    {
        $this->app = new Application('query');
    }

    function buildModels()
    {
        $this->app->setModels([
            'Question', 'Answer', 'Reply', 'Game'
        ]);
    }

    function buildControllers()
    {
        $this->app->setControllers([
            'QuestionController'
        ]);
    }

    function buildMigrations()
    {
        $this->app->setMigrations([
            'question', 'answer', 'game', 'reply'
        ]);
    }

    function buildViews()
    {
        $this->app->setViews([
            'question'
        ]);
    }
}