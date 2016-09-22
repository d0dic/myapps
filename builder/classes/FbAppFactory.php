<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 2:50 PM
 */

namespace app\classes;

/**
 * Class FbAppFactory
 * @package app\classes
 */
class FbAppFactory extends AppFactory
{
    /**
     * @var FbAppBuilder
     */
    private $builder;

    /**
     * @param FbAppBuilder $builder
     */
    private function setBuilder(FbAppBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param string $type
     * @return FbApplication
     * @throws \Exception
     */
    public function create($type)
    {
        switch ($type) {
            case 'query':
                $this->setBuilder(new QueryAppBuilder());
                break;

            case 'gallery':
                $this->setBuilder(new GalleryAppBuilder());
                break;

            case 'puzzle':
                $this->setBuilder(new PuzzleAppBuilder());
                break;

            default:
                $this->setBuilder(new DefaultAppBuilder());
        }

        $this->builder->createApp();

        $this->builder->buildModels();
        $this->builder->buildControllers();
        $this->builder->buildMigrations();
        $this->builder->buildViews();

        return $this->builder->getApp();
    }
}