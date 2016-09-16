<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 16-Sep-16
 * Time: 6:43 PM
 */

namespace app\assets;

use PHPMailer;

/**
 * Class Mailer
 * @package app\assets
 */
class Mailer
{
    private $mailer;

    /**
     * Mailer constructor
     */
    public function Mailer(){
        $this->mailer = new PHPMailer(true);
    }
}