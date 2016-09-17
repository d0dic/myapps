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
    private static $instance;

    /**
     * Mailer constructor
     */
    private function __construct(){
        $this->init();
    }

    /**
     * @return Mailer
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Mailer();
        }

        # dump(self::$instance); die;
        return self::$instance;
    }

    /**
     * Instantiating PHPMailer
     */
    private function init(){

        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();                    // Set mailer to use SMTP
        $this->mailer->SMTPAuth = true;             // Enable SMTP authentication
        $this->mailer->Host = 'smtp.gmail.com';     // Specify main and backup SMTP servers
        $this->mailer->Username = 'epostar011';     // SMTP username
        $this->mailer->Password = 'lozinka123';     // SMTP password
        $this->mailer->SMTPSecure = 'tls';          // Enable TLS encryption, `ssl` also accepted
        $this->mailer->Port = 587;
    }

    /**
     * @param $subject
     * @param $messsage
     * @param $from
     * @param $to
     * @param $attachment
     * @param $isHtml
     */
    public function create(
        $subject, $messsage, $from, $to , $attachment, $isHtml)
    {
        $this->mailer->isHTML($isHtml);
        $this->mailer->setFrom($from['email'], $from['name']);
        $this->mailer->addAddress($to['email'], $to['name']);

        if ($attachment) {
            $this->mailer->addAttachment($attachment);
        }

        $this->mailer->Subject = $subject;
        $this->mailer->Body = $messsage;

    }

    /**
     * @return string
     */
    public function send()
    {
        if (!$this->mailer->send()) {
            return 'Mailer Error: ' . $this->mailer->ErrorInfo;
        } else {
            return 'Message has been sent';
        }
    }
}