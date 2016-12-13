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
            'Poster.php', 'PosterSearch.php', 'Like.php'
        ]);
    }

    function buildControllers()
    {
        $this->app->setControllers([
            'PosterController.php'
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
//            'm160906_111235_poster.php', 'm160906_144443_like.php'
//        ]);
    }

    function buildViews()
    {
        $this->app->setViews([
            'poster' // view folders only
        ]);
    }
}