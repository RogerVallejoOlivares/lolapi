<?php
/**
 * Created by PhpStorm.
 * User: matalords
 * Date: 23/05/2019
 * Time: 13:17
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

$_SESSION['current_page'] = 'settings';

include_once('templates/imports.template.php');
include_once('templates/navbarUsers.template.php');


?>

<div class="formSettings">
    <div class="formSettings-content" style="background-image: url('img/bgFormSett.jpg')">
        <form class="form-detail" action="" method="post">
            <h2>Personal info</h2>
            <div class="form-row-total">
                <div class="form-row">

                    <input type="email" id="email" class="input-text" readonly><!-- valor que viene de la bbdd -->
                </div>
            </div>
            <div class="form-row-total">
                <div class="form-row">
                    <input type="text" name="name" id="name" class="input-text" placeholder="Name">
                </div>
                <div class="form-row">
                    <input type="text" name="lname" id="lname" class="input-text" placeholder="Last Name">
                </div>
            </div>
            <div class="form-row-total">
                <div class="form-row">
                    <input type="date" class="input-text" id="dateSign" name="date">
                </div>
                <div class="form-row">
                    <input type="text" id="phoneSing" class="input-text"  name="phone" placeholder="Phone">
                </div>
            </div>

            <div class="form-row-total">
                <div class="form-row">
                    <input type="password" name="password" id="password" class="input-text" placeholder="Your Password" required>
                </div>
                <div class="form-row">
                    <input type="password" name="comfirm-password" id="comfirm-password" class="input-text" placeholder="Comfirm Password" required>
                </div>
            </div>
            <div class="form-row-last">
                <input type="submit" name="modify" class="register" value="Modify">
            </div>
        </form>
    </div>
</div>

<?php

    include_once('templates/footer.template.php');

?>