<?php
/**
 * Index File
 * php version 7.4.2
 *
 * @category Controller_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

namespace App\Controllers;

use \Framework\Core\Controller as Controller;
use \Framework\Libraries\CSRF as CSRF;

/**
 * Controller Class - Index controller class
 * php version 7.4.2
 *
 * @category Controller_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */
class Index extends Controller
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
     * Index function
     *
     * @return void
     */
    public function index()
    {
        // $data = [
        //     "demo" => $this->_helpers["demo"]("Hello! World."),
        // ];

        // parent::view("index", $data);
        echo CSRF::new("TESTID");
        echo "<pre>";
        var_dump($_SESSION["csrf_tokens"]);

    }
}
