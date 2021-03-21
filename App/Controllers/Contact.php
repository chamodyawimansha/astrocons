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
        $new = new ContactForm;
    }
}
