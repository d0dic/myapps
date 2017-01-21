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
    private $host;
    private $port;
    private $username;
    private $password;

    private $mailer;
    private static $instance;

    /**
     * Mailer constructor.
     */
    private function __construct(){
        $this->setParams();
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
     * Set Mailer parameters
     */
    private function setParams(){
        $this->host = app()['params']['mail']['host'];
        $this->port = app()['params']['mail']['port'];
        $this->username = app()['params']['mail']['username'];
        $this->password = app()['params']['mail']['password'];

        $this->setMailer();
    }

    /**
     * Instantiating PHPMailer
     */
    private function setMailer(){

        $this->mailer = new PHPMailer();

        $this->mailer->isSMTP();                    // Set mailer to use SMTP
        # $this->mailer->SMTPDebug = 3;             // Set mailer debug on
        $this->mailer->SMTPAuth = true;             // Enable SMTP authentication

        $this->mailer->Host = $this->host;          // Specify main and backup SMTP servers
        $this->mailer->Username = $this->username;  // SMTP username
        $this->mailer->Password = $this->password;  // SMTP password
        $this->mailer->Port = $this->port;          // Server port
        $this->mailer->SMTPSecure = 'tls';          // Enable TLS encryption,
                                                    // `ssl` also accepted
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
            return 'Message has been sent successfully!';
        }
    }
}