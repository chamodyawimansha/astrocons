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
use Framework\Core\Logger as Logger;

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
    private $_sender;
    private $_senderEmail;
    private $_sendersIp;
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
     * @param $name      - Name of the user
     * @param $email     - Email of the user
     * @param $subject   - Subject for the email
     * @param $message   - Email body
     * @param $sendersIp - Senders ip address for spam protection
     * 
     * @return void
     */
    public function __construct($name, $email, $subject, $message, $sendersIp)
    {
        $this->_sender = $name;
        $this->_senderEmail = $email;
        $this->_subject = $subject;
        $this->_message = $message;
        $this->_sendersIp = $sendersIp;

        // Loading the SMTP configurations
        $this->_smtpHost = $GLOBALS['configs']['smtp_host'] ?? "";
        $this->_smtpUsername = $GLOBALS['configs']['smtp_username'] ?? "";
        $this->_smtpName = $GLOBALS['configs']['smtp_name'] ?? "";
        $this->_smtpPassword = $GLOBALS['configs']['smtp_password'] ?? "";
        $this->_smtpPort = $GLOBALS['configs']['smtp_port'] ?? "";
        $this->_smtpEncryption = $GLOBALS['configs']['smtp_encryption'] ?? "";

        $this->_webmasterAddress = $GLOBALS['configs']['webmasters_address'] ?? "";
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
        echo $this->_save();
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
     * Saves the message time in the session for a temporary
     * 
     * @return boolean
     */
    private function _save()
    {   
        if (!isset($_SESSION["message_time"])) {
            $_SESSION["message_time"] = date('Y-m-d H:i:s');
        }
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