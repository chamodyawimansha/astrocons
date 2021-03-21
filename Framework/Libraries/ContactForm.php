<?php
/**
 * ContactForm File
 * php version 7.4.2
 *
 * @category Library_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

namespace Framework\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//  use Mail;

/**
 * ContactForm Class - Uses the PHPMailer class to send emails 
 * php version 7.4.2
 *
 * @category Library_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

class ContactForm
{

    private $_dbHost;
    private $_dbUser;
    private $_dbPass;
    private $_dbName;


    private $_sender;
    private $_subject;
    private $_message;

    private $_smtpHost;
    private $_smtpUsername;
    private $_smtpName;
    private $_smtpPassword;
    private $_smtpPort;
    private $_smtpEncryption;

    private $_webmasterAddress;

    private $_totalMessagesPerDay = 5;


    /**
     * Gets the required data from config
     * 
     * @param $sender    - Email of the user who filled the contact form
     * @param $subject   - Subject of the email
     * @param $message   -  Email body
     * @param $sendersIp - Senders ip address for spam protection
     * 
     * @return void
     */
    public function __construct($sender, $subject, $message, $sendersIp)
    {
        echo $sendersIp;
    }

    /**
     * Sends the emails to WebMasters and to the user
     * 
     * @param $confirmation - Whether to send a confirmation email to the user
     * 
     * @return boolean
     */
    public function send($confirmation = false)
    {

    }

    /**
     * Checks the ip address in the database
     * previous message time periods to figure out a 
     * spam or not
     * 
     * @return boolean
     */
    public function isItSpam()
    {

    }

    /**
     * Sends a confirmation email to the user
     *  
     * @return boolean
     */
    private function _sendConfirmation()
    {

    }

    /**
     * Saves the message in the database
     * 
     * @return boolean
     */
    private function _save()
    {

    }


}

        // $mail = new PHPMailer(true);
                            
        // //Set PHPMailer to use SMTP.
        // $mail->isSMTP();            
        // //Set SMTP host name                          
        // $mail->Host = "smtp.gmail.com";
        // //Set this to true if SMTP host requires authentication to send email
        // $mail->SMTPAuth = true;                          
        // //Provide username and password     
        // $mail->Username = "Duobrothers.wordpress@gmail.com";                 
        // $mail->Password = "2^FtGp7$";                           
        // //If SMTP requires TLS encryption then set it
        // $mail->SMTPSecure = "tls";                           
        // //Set TCP port to connect to
        // $mail->Port = 587;                                   

        // $mail->From = "name@gmail.com";
        // $mail->FromName = "Full Name";

        // $mail->addAddress("chamodyawimansha@gmail.com", "chamodya wimansha");

        // $mail->isHTML(true);

        // $mail->Subject = "Subject Text";
        // $mail->Body = "<i>Mail body in HTML</i>";
        // $mail->AltBody = "This is the plain text version of the email content";

        // try {
        //     $mail->send();
        //     echo "Message has been sent successfully";
        // } catch (Exception $e) {
        //     echo "Mailer Error: " . $mail->ErrorInfo;
        // }