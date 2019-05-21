<?php
/**
 * Main page for Users
 */

    if(!isset($_SESSION)) {
        session_start();
    }

    $_SESSION['current_page'] = 'main';

    include_once('templates/imports.template.php');

    include_once('templates/navbarUsers.template.php');

    include_once('templates/header.template.php')

?>



<?php

    include_once('templates/footer.template.php');

?>