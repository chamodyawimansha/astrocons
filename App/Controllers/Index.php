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
    private $_classParams;

    /**
     * Loads when object called
     * 
     * @return void
     */
    public function __construct()
    {
        $this->_helpers = parent::helpers(["demo"]);
        $this->_classParams = $_SESSION['index'] ?? [];
    }

    /**
     * Index function
     *
     * @param $params - Url parameters
     * 
     * @return void
     */
    public function index($params = [])
    {

        $data = [
            "demo" => $this->_helpers["demo"]("Hello! World."),
            "contact_csrf" => CSRF::new("contact_csrf"),
            "messages" => $this->_classParams["messages"] ?? []
        ];
        
        parent::view("index", $data);
      
    }
}
