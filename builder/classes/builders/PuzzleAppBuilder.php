<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 2:42 PM
 */

namespace app\classes\builders;

use app\classes\applications\FbApplication;

/**
 * Class PuzzleAppBuilder
 * @package app\classes\builders
 */
class PuzzleAppBuilder extends FbAppBuilder
{

    function createApp()
    {
        $this->app = new FbApplication('puzzle');
    }

    function buildModels()
    {
        $this->app->setModels([
            'Game.php', 'Topscore.php', 'Puzzle.php',
            'PuzzleSearch.php', 'Piece.php'
        ]);
    }

    function buildControllers()
    {
        $this->app->setControllers([
            'PuzzleController.php'
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
//            'game', 'topscore', 'piece', 'puzzle'
//        ]);
    }

    function buildViews()
    {
        $this->app->setViews([
            'puzzle'
        ]);
    }
}