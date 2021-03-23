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
    private $_subject;
    private $_message;

    private $_smtp;
    private $_smtpHost;
    private $_smtpUsername;
    private $_smtpName;
    private $_smtpPassword;
    private $_smtpPort;
    private $_smtpEncryption;

    private $_webmasterAddress;
    private $_webmasterName;

    /**
     * Gets the required data from config
     * 
     * @param $name    - Name of the user
     * @param $email   - Email of the user
     * @param $subject - Subject for the email
     * @param $message - Email body
     * 
     * @return void
     */
    public function __construct($name, $email, $subject, $message)
    {
        $this->_sender = $name;
        $this->_senderEmail = $email;
        $this->_subject = $subject;
        $this->_message = $message;

        // Loading the SMTP configurations
        $this->_smtpHost = $GLOBALS['configs']['smtp_host'] ?? "";
        $this->_smtpUsername = $GLOBALS['configs']['smtp_username'] ?? "";
        $this->_smtpName = $GLOBALS['configs']['smtp_name'] ?? "";
        $this->_smtpPassword = $GLOBALS['configs']['smtp_password'] ?? "";
        $this->_smtpPort = $GLOBALS['configs']['smtp_port'] ?? "";
        $this->_smtpEncryption = $GLOBALS['configs']['smtp_encryption'] ?? "";

        $this->_webmasterAddress = $GLOBALS['configs']['webmaster_address'] ?? "";
        $this->_webmasterName = $GLOBALS['configs']['webmaster_name'] ?? 
                                    "Webmaster";

    }

    /**
     * Sends the emails to WebMasters and to the user
     * 
     * @param $confirmation - Whether to send a confirmation email to the user
     * 
     * @return boolean
     */
    public function send($confirmation)
    {
        $d = date('Y-m-d H:i:s');
        $html = <<<HTML
            <body style="background:#ddd">
                <div style="width:500px;background:#f4f4f4;margin:auto;height:100vh">
                    <h1 style=
                        "background: #272727; 
                        color:#ffe400;
                        padding:5px;
                        text-align:center;"
                    >
                        ASTROCONS
                    </h1>
                    <div style="padding: 10px 50px">

                    <table>
                        <tr>
                            <th style="width:75px;padding:10px;text-align:right;">
                                <strong>Name :</strong>
                            </th>
                            <td>$this->_sender</td>
                        <tr>
                        <tr>
                            <th style="padding:10px;text-align:right;">
                                <strong>Email :</strong>
                            </th>
                            <td>$this->_senderEmail</td>
                        <tr>
                        <tr>
                            <th style="padding:10px;text-align:right;">
                                <strong>Subject :</strong>
                            </th>
                            <td>$this->_subject</td>
                        <tr>
                        <tr>
                            <th style="padding:10px;text-align:right;">
                                <strong>Message :</strong>
                            </th>
                            <td>$this->_message</td>
                        <tr>
                    </table>
                    <p style="margin: 50px 0;background:#ddd;padding:10px">
                        This is an Automatically generated message from 
                        <a href="astrocons.co.uk">Astrocons.co.uk</a>
                    </p>

                    <p style="margin-bottom: 50px">
                        Send a Reply : 
                        <a href="
                        mailto:{$this->_senderEmail}?subject=Re:{$this->_subject}"
                        >
                            $this->_senderEmail
                        </a>
                    </p>
                    <code>
                        Email generated on : $d
                    </code>
                    </div>
                </div>
            </body>
        HTML;

        $this->_save();
        $this->_smtpinit();

        $this->_emailinit(
            $this->_webmasterAddress,
            $this->_webmasterName,
            $this->_subject,
            $html,
            $this->_message
        );

        try {
            // send the email and log it
            $this->_smtp->send();
            Logger::log("PHPMailer - Email Sended");
        } catch (Exception $e) {
            // log the error and returning false if the email failed to send
            Logger::log(
                "PHPMailer Error: " . 
                $this->_smtp->ErrorInfo . 
                "[". $e . "]",
                1
            );
            return false;
        }

        // sending confirmation email
        if ($confirmation) {
            return $this->_sendConfirmation();
        }

        return true;
    }

    /**
     * Sends a confirmation email to the user
     *  
     * @return boolean
     */
    private function _sendConfirmation()
    {
        $d = date('Y-m-d H:i:s');
        $html = <<<HTML
            <body style="background:#ddd">
                <div style="width:500px;background:#f4f4f4;margin:auto;height:100vh">
                    <h1 style=
                        "background: #272727; 
                        color:#ffe400;
                        padding:5px;
                        text-align:center;"
                    >
                        ASTROCONS
                    </h1>
                    <div style="padding: 10px 50px">
                    <p>Hello there,</p>
                    <p style="line-height:1.4rem">Thankyou for contacting us. 
                        we will reply to your message soon.
                    </p>
                    <p style="margin-top:50px">
                         Thanks in advance.
                    </p>
                    <p style="margin: 100px 0 10px;background:#ddd;padding:10px">
                        This is an Automatically generated message from 
                        <a href="astrocons.co.uk">Astrocons.co.uk</a>
                    </p>
                    <code>
                        Email generated on : $d
                    </code>
                    </div>
                </div>
            </body>
        HTML;


        $this->_emailinit(
            $this->_senderEmail,
            $this->_sender,
            $this->_subject,
            $html,
            "Thankyou for contacting us. we will reply to your message soon."
        );

        try {
            // send the email and log it
            $this->_smtp->send();
            Logger::log("PHPMailer - Confirmation email Sended");
            return true;
        } catch (Exception $e) {
            // log the error and returning false if the email failed to send
            Logger::log(
                "PHPMailer confirmation email error: " . 
                $this->_smtp->ErrorInfo . 
                "[". $e . "]",
                1
            );
            return false;
        }
    }

    /**
     * Saves the message time in the session for a temporary
     * 
     * @return void
     */
    private function _save()
    {   
        if (!isset($_SESSION["message_time"])) {
            $_SESSION["message_time"] = date('Y-m-d H:i:s');
        }
    }

    /**
     * Initiates the smtp settings
     * 
     * @return void
     */
    private function _smtpinit()
    {
        $this->_smtp = new PHPMailer(true);
        // set the PHPMailer to smtp mode
        $this->_smtp->isSMTP();

        $this->_smtp->Host = $this->_smtpHost;
        
        // PHPMailer smtp authentication set to true
        $this->_smtp->SMTPAuth = true;
        
        // login using smtp username and password
        $this->_smtp->Username = $this->_smtpUsername;
        $this->_smtp->Password = $this->_smtpPassword;
        
        // set the PHPMailer smtp host authentication to send emails
        $this->_smtp->SMTPSecure =  $this->_smtpEncryption;

        // PHPMailer smtp port
        $this->_smtp->Port = $this->_smtpPort;
    }

    /**
     * Initiates email headers and body
     * 
     * @param $receiverEmail - Receiver's email address
     * @param $receiverName  - Receiver's name
     * @param $subject       - Subject of the email
     * @param $textBody      - Body of the email
     * @param $altBody       - Alternative text of the email - short form
     * 
     * @return void
     */
    private function _emailinit(
        $receiverEmail, $receiverName, $subject, $textBody, $altBody
    ) {
        // details of the user
        $this->_smtp->From = $this->_smtpUsername;
        $this->_smtp->FromName = $this->_smtpName;

        // web masters details
        $this->_smtp->addAddress($receiverEmail, $receiverName);

        $this->_smtp->isHTML(true);

        $this->_smtp->Subject = $subject;
        $this->_smtp->Body = $textBody;
        $this->_smtp->AltBody = $altBody;

    }
}