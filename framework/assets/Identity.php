<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 16-Sep-16
 * Time: 1:57 PM
 */

namespace app\assets;

/**
 * Interface Identity
 * @package app\assets
 */
interface Identity
{
    /**
     * @return mixed
     */
    public function getIdentity();

    /**
     * @return mixed
     */
    public function getAccessToken();

    /**
     * @return mixed
     */
    public function getType();

    /**
     * @return mixed
     */
    public function getId();
}