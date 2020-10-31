<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once "../../rotes.php";

require $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_BUSINESS_LIB . "PHPMailer/SMTP.php";
require $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_BUSINESS_LIB . "PHPMailer/Exception.php";
require $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_BUSINESS_LIB . "PHPMailer/PHPMailer.php";





/**
 * Class in charge of sending emails through the PHPMailer library
 */
class SendMail
{
    //----------------------------------
    // Attributes
    //----------------------------------

    const LIBRARY_NAME = "FERIA DE OPORTUNIDADES - UEB";
    const LIBRARY_MAIL = "feriaoportunidadtestmail@gmail.com";
    const LIBRARY_PASSWORD = "123456789Abc";

    /**
     * Recipient's mail
     * 
     * @var String
     */
    private $mailRecipient;

    /**
     * Topic of mail
     * 
     * @var String
     */
    private $mailSubject;

    /**
     * Name of recipient
     * 
     * @var String
     */
    private $recipientName;

    /**
     * Mail message
     * 
     * @var String
     */
    private $mailMessage;

    /**
     * PHPMailer lib
     * 
     * @var PHPMailer
     */
    private $phpMail;


    //----------------------------------
    // Builder
    //----------------------------------

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        try {
            //Server settings
            $this->mail->SMTPDebug = 0; // Enable verbose debug output
            $this->mail->isSMTP(); // Send using SMTP
            $this->mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $this->mail->SMTPAuth = true; // Enable SMTP authentication
            $this->mail->Username = self::LIBRARY_MAIL; // SMTP username
            $this->mail->Password = self::LIBRARY_PASSWORD; // SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            $this->mail->CharSet = 'UTF-8';

            //Recipients
            $this->mail->setFrom(self::LIBRARY_MAIL, self::LIBRARY_NAME);
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }


    //----------------------------------
    // Methods
    //----------------------------------


    /**
     * Method for preparing mail to be sent with recipient, subject and message
     * 
     * @param String $pMailRecipient
     * @param String $pMailSubject
     * @param String $pMailMessage
     */
    public function prepareMail(String $pMailRecipient, String $pMailSubject, String $pMailMessage)
    {
        $this->setMailRecipient($pMailRecipient);
        $this->setpMailSubject($pMailSubject);
        $this->setMailMessage($pMailMessage);
    }


    /**
     * Method for sending the mail with the attributes recipient, subject and message
     * 
     */
    public function sendMail()
    {
        try {

            $this->mail->addAddress($this->correoDestinatario); // Add a recipient

            // Contenido

            $this->mail->isHTML(true); // Set email format to HTML
            $this->mail->Subject = $this->asunto; // ASUNTO
            $this->mail->Body    = $this->mensaje; // MENSAJE

            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }


    /**
     * Method for obtaining the recipient mail
     * 
     * @return String
     */
    public function getMailRecipient()
    {
        return $this->mailRecipient;
    }

    /**
     * Method for setting the recipient's mail
     * 
     * @param String
     */
    public function setMailRecipient(String $pMailRecipient)
    {
        $this->mailRecipient = $pMailRecipient;
    }

    /**
     * Method for obtaining the mail subject
     * 
     * @return String
     */
    public function getMailSubject()
    {
        return $this->mailSubject;
    }

    /**
     * Method for setting the mail subject
     * 
     * @param String
     */
    public function setpMailSubject(String $pMailSubject)
    {
        $this->mailSubject = $pMailSubject;
    }

    /**
     * Method for obtaining the recipient name
     * 
     * @return String
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * Method for setting the recipient name
     * 
     * @param String
     */
    public function setRecipientName(String $pRecipientName)
    {
        $this->recipientName = $pRecipientName;
    }

    /**
     * Method for obtaining the mail message
     * 
     * @return String
     */
    public function getMailMessage()
    {
        return $this->mailMessage;
    }

    /**
     * Method for setting the mail message
     * 
     * @param String
     */
    public function setMailMessage(String $pMailMessage)
    {
        $this->mailMessage = $pMailMessage;
    }
}