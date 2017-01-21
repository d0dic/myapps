<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 11:37 AM
 */

namespace patterns\builder;

/**
 * Class CarFactory
 * @package patterns\builder
 */
class CarFactory
{
    /**
     * @var CarBuilder
     */
    private $builder;

    /**
     * @param $type
     * @return Car
     */
    public function createCar($type)
    {
        switch ($type){
            case 'confort':
                $this->builder = new MercedesCarBuilder();
                break;
            case 'elegance':
                $this->builder = new AudiCarBuilder();
                break;
            case 'racing':
                $this->builder = new BMWCarBuilder();
                break;
            default:
                die('Category not availible!');
        }

        $this->builder->createCar();

        $this->builder->buildSchell();
        $this->builder->buildEngine();
        $this->builder->buildEnterier();
        $this->builder->buildWheels();

        return $this->builder->getCar();
    }

}