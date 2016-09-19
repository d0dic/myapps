<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 2:50 PM
 */

namespace app\classes;

/**
 * Class AppFactory
 * @package app\classes
 */
class AppFactory
{
    /**
     * @var AppBuilder
     */
    private $builder;

    /**
     * @param AppBuilder $builder
     */
    private function setBuilder(AppBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param string $type
     * @return Application
     * @throws \Exception
     */
    public function create($type)
    {
        switch ($type) {
            case 'query':
                $this->setBuilder(new QuestionnaireBuilder());
                break;

            case 'gallery':
                $this->setBuilder(new PhotoContestBuilder());
                break;

            case 'puzzle':
                $this->setBuilder(new PuzzleMatchBuilder());
                break;

            default:
                throw new \Exception('Application type not implemented!');
        }

        $this->builder->createApp();

        $this->builder->buildModels();
        $this->builder->buildControllers();
        $this->builder->buildMigrations();
        $this->builder->buildViews();

        return $this->builder->getApp();
    }
}