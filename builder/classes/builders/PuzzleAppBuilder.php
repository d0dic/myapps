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
//            'm160908_102648_game.php', 'm160908_104757_topscore.php',
//            'm160908_150957_piece.php', 'm160908_143843_puzzle.php'
//        ]);
    }

    function buildViews()
    {
        $this->app->setViews([
            'puzzle' // view folders only
        ]);
    }
}