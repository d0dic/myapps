<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 2:46 PM
 */

namespace app\classes\builders;

use app\classes\applications\FbApplication;

/**
 * Class GalleryAppBuilder
 * @package app\classes\builders
 */
class GalleryAppBuilder extends FbAppBuilder
{

    function createApp()
    {
        $this->app = new FbApplication('gallery');
    }

    function buildModels()
    {
        $this->app->setModels([
            'Poster', 'PosterSearch', 'Like'
        ]);
    }

    function buildControllers()
    {
        $this->app->setControllers([
            'PosterController'
        ]);
    }

    function buildMigrations()
    {
        $this->app->setMigrations([
            'poster', 'like'
        ]);
    }

    function buildViews()
    {
        $this->app->setViews([
            'poster'
        ]);
    }
}