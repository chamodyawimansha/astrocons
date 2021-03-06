<?php
/**
 * Message Controller File
 * php version 7.4.2
 *
 * @category Controller_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/astrocons
 */

namespace App\Controllers;

use \Framework\Core\Controller as Controller;
use \Framework\Libraries\ContactForm as ContactForm;
use \Framework\Libraries\CSRF as CSRF;
use \Framework\Core\Logger as Logger;

/**
 * Message Class - Sending new Messages
 * php version 7.4.2
 *
 * @category Controller_Class
 * @package  Asctrocons.co.uk
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/astrocons
 */
class Contact extends Controller
{
    private $_helpers;

    /**
     * Loads when object called
     *
     * @return void
     */
    public function __construct()
    {
        $this->_helpers = parent::helpers(["demo"]);
    }

    /**
     * Index function - only post request
     *
     * @return void
     */
    public function new()
    {

        // check for request type
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // if not a post request
            Logger::httpStatus(404, "404 Not Found");
            die();
        }

        // check for spam
        if (!isset($_POST["full_name"]) && !empty($_POST["full_name"])) {
            
            // if honeypot field is not empty consider as a spam
            Logger::httpStatus(400, "400 Bad Request");
            die();
        }

        // check if the user has send a message previously
        if (ContactForm::isSpamming()) {
            return parent::redirect(
                "index/index/#contact",
                [
                    "index_contact_alert" => [
                        "type" => "warning",
                        "message" => "Our system indicates that you have
                                     send us more than 5 messages. Please try 
                                     again later."
                    ]
                ],
            );
        }

        $token = filter_var($_POST['contact_csrf'] ?? "", FILTER_SANITIZE_STRING);

        // authenticate the form for protection against CSRF.
        if (!CSRF::check('contact_csrf', $token)) {
            // If the html form not valid
            Logger::httpStatus(400, "400 Bad Request");
            die();
        }

        $name = filter_var($_POST['name'] ?? "", FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'] ?? "", FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'] ?? "", FILTER_SANITIZE_STRING);
        $message = filter_var($_POST['message'] ?? "", FILTER_SANITIZE_STRING);

        $confirmation = filter_var(
            $_POST['confirm-email'] ?? "", 
            FILTER_SANITIZE_STRING
        );
        
        // get the users ip address for spam protection
        $sendersIp = $_SERVER['REMOTE_ADDR'];

        $form = new ContactForm($name, $email, $subject, $message);

        if ($form->send($confirmation)) {
            // emails sended successfully
            return parent::redirect(
                "index/index/#contact",
                [
                    "index_contact_alert" => [
                        "type" => "success",
                        "message" => "Thank you for getting in touch, 
                                     We appreciate you contacting us. 
                                     We will get back in touch with you soon."
                    ]
                ],
            );
            
        } else {
            // email sending failed
            return parent::redirect(
                "index/index/#contact",
                [
                    "index_contact_alert" => [
                        "type" => "failed",
                        "message" => "It seems like there is an issue with your 
                                     message reaching us. please try again shortly!."
                    ]
                ],
            );
        }
    }
}
