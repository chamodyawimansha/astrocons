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

 require "Mail.php";
/**
 * ContactForm Class - Uses the Pear::Mail class to send emails 
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
    /**
     * Runs when Object creating
     * 
     * @return void
     */
    public function __construct()
    {

        $host = "smtp.gmail.com";
        $port = 587;
        $username = "duobrothers.wordpress@gmail.com";
        $password = "2^FtGp7$";


        $from = "website <chamodya@duobrothers.com>";
        $to = "Me <chamodyawimansha@gmail.com>";
        $replyto = "Visitor <reply-to@your-email-here.com>";


        $subject = "Hi!";
        $body = "Hi,\n\n Test from my website";


        $headers = array ('From' => $from,
        'To' => $to,
        'Subject' => $subject,
        'Reply-To' =>$replyto);
        
        $smtp = Mail::factory(
            'smtp',
            array ('host' => $host,
            'port' => $port,
            'auth' => true,
            'username' => $username,
            'password' => $password)
        );

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
                echo("<p>" . $mail->getMessage() . "</p>");
        } else {
                echo("<p>Message successfully sent!</p>");
        }
    }

}