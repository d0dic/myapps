<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 2:42 PM
 */

namespace app\classes;


class PuzzleAppBuilder extends FbAppBuilder
{

    function createApp()
    {
        $this->app = new FbApplication('puzzle');
    }

    function buildModels()
    {
        $this->app->setModels([
            'Game', 'Topscore', 'Puzzle', 'PuzzleSearch', 'Piece'
        ]);
    }

    function buildControllers()
    {
        $this->app->setControllers([
            'PuzzleController'
        ]);
    }

    function buildMigrations()
    {
        $this->app->setMigrations([
            'game', 'topscore', 'piece', 'puzzle'
        ]);
    }

    function buildViews()
    {
        $this->app->setViews([
            'puzzle'
        ]);
    }
}