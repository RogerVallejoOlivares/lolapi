<?php
/**
 * Main page for Users
 */

    if(!isset($_SESSION)) {
        @session_start();
    }
    
    include('inc.config.php');
    require(CWD.'includes/inc.user.php');

    $returnUrl = 'index.php';
    $currentUser = User::getCurrentUser();

    if($currentUser === FALSE || ($currentUser !== FALSE && !$currentUser->isLogged())) {
        @header('Location: '.$returnUrl);     
        exit();
    }

    $_SESSION['current_page'] = 'main';

    include_once('templates/imports.template.php');
    include_once('templates/navbarUsers.template.php');
    include_once('templates/header.template.php')
    
?>

<a id="btnSearchGame" class="boxShadowBlue" >Search Game</a>

<?php

    include_once('templates/footer.template.php');

?>