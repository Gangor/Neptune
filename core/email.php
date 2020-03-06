<?php

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require  PLUGINS. '/PHPMailer/OAuth.php';
require  PLUGINS. '/PHPMailer/Exception.php';
require  PLUGINS. '/PHPMailer/PHPMailer.php';
require  PLUGINS. '/PHPMailer/SMTP.php';

class Email
{
    /**
     * Objet php mailer
     * @var object $mail
     */
    private $mail;

    function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true; 
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Host = SMTP_HOST;
        $this->mail->Port = SMTP_PORT;
        $this->mail->Username = SMTP_USER;
        $this->mail->Password = SMTP_PASSWORD;
        $this->mail->CharSet = PHPMailer::CHARSET_UTF8;
    }

    /**
     *  
     * Envoi un mail avec un template
     * 
     * @param object $user  Utilisateur à qui envoyer le mail
     * @param string $title Suject du mail
     * @param string $viewname Template du mail
     * @param object $attach Fichier à joindre au mail
     * 
     */
    function Send( object $user, string $title, string $viewname, object $attach = null )
    {
        $file = MAILS. '/'. $viewname .'.php';

        if ( !is_file( $file ) )
            return false;
        
        ob_start();
        require( $file );

        $this->mail->msgHTML( ob_get_clean() );
        $this->mail->addAddress( $user->identifiant );
        $this->mail->setFrom( SMTP_USER, SMTP_NAME );
        $this->mail->Subject = $title;

        if ( $attach )
            $this->mail->addStringAttachment( $attach->content, $attach->filename );

        if (!$this->mail->send()) {
            throw new Exception( 'Mailer Error: '. $this->mail->ErrorInfo );
        } else {
            return true;
        }
    }
}

?>