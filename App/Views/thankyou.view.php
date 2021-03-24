<?php
/**
 * Thankyou view File
 * php version 7.4.2
 *
 * @category View_File
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/astrocons
 */

 require VIEW_FOLDER . "partials/header.php";
?>


<div class="alert-container">
    <div class="thanking-note">
    <h1>
        Thank you for getting in touch! 
    </h1>
    <p>
        We appreciate you contacting Astro constructions. 
        One of our colleagues will get back in touch with you soon!
    </p>
    <p>Have a great day!</p>
    <img src="/public/images/astro-logo-large.jpeg" alt="Astro Logo">
        <div class="alert-footer">
            <p 
                class="copy-notice">
                    Copyright &copy; 2021 
                    <?php echo date("Y") == "2021" ? "" : "-" . date("Y"); ?>
                    <a href="astrocons.co.uk">
                        astrocons.co.uk.
                    </a> 
                        All Rights Reserved.
            </p>
        </div>
    </div>
</div>
</body>
</html>