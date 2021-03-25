<?php
/**
 * Index View footer partial File
 * php version 7.4.2
 *
 * @category View_File
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/astrocons
 */
?>
    <footer>
        <div class="container flex">
            <p 
                class="copy-notice">
                    Copyright &copy; 2021 
                    <?php echo date("Y") == "2021" ? "" : "-" . date("Y"); ?>
                    <a href="astrocons.co.uk">
                        astrocons.co.uk.
                    </a> 
                        All Rights Reserved.
            </p>
            <a href="#intro" class="go-top-btn">Top</a>
        </div>
    </footer>
    <script src="/public/scripts/js.js"></script>
</body>
</html>