<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 11:29 AM
 */

namespace patterns\factory;

/**
 * Class AppGenerator
 * @package factory
 */
class AppGenerator
{
    public function make($type)
    {
        $app = false;

        switch ($type){

            case 'query':
                $app = new Questionnaire();
                break;
            case 'puzzle':
                $app = new Puzzlematch();
                break;
            case 'gallery':
                $app = new Photocontest();
                break;
            default:
                $app = new \ArrayObject();
                break;
        }

        return $app;
    }

}