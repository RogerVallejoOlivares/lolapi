<?php
/**
 * Created by PhpStorm.
 * User: matalords
 * Date: 23/05/2019
 * Time: 13:17
 */
if (!isset($_SESSION)) {
    @session_start();
}

include('inc.config.php');
require(CWD . 'includes/inc.user.php');

$returnUrl = 'index.php';
$currentUser = User::getCurrentUser();
$messageResponse = "";

if ($currentUser === FALSE || ($currentUser !== FALSE && !$currentUser->isLogged())) {
    @header('Location: ' . $returnUrl);
    exit();
}

$_SESSION['current_page'] = 'settings';

include_once('templates/imports.template.php');
include_once('templates/navbarUsers.template.php');

if (isset($_POST['modify'])) {
    $name = $_POST['name'];
    $lastName = $_POST['lname'];
    $phone = $_POST['phone'];
    $birthDay = $_POST['date'];
    $pwd = $_POST['password'];
    $pwd2 = $_POST['password2'];

    if (isset($name) && isset($lastName) && isset($phone) && isset($birthDay)) {
        $currentUser->setName($name);
        $currentUser->setLastName($lastName);
        $currentUser->setPhone($phone);
        $currentUser->setBirthday($birthDay);

        if ((isset($pwd) && isset($pwd2)) && (!empty($pwd) && !empty($pwd2))) {
            if ($pwd != $pwd2) {
                $messageResponse = 'provided passwords dont match';
            } else {
                $currentUser->setPassword($pwd);
            }
        }

        $currentUser->save();
        $messageResponse = 'Settings were modified successfully!';
    } else {
        $messageResponse = 'Please, fill all fields';
    }

//header('Location: mainPage.php');
//exit();
}
?>

<div class="formSettings">
    <div class="formSettings-content" style="background-image: url('img/bgFormSett.jpg')">
        <form class="form-detail" action="" method="post">
            <h2>Personal info</h2>
            <div class="form-row-total">
                <div class="form-row">

                    <input type="email" id="email" class="input-text" value="<?= $currentUser->getEmail() ?>" readonly><!-- valor que viene de la bbdd -->
                </div>
            </div>
            <div class="form-row-total">
                <div class="form-row">
                    <input type="text" name="name" id="name" class="input-text" value="<?= $currentUser->getName() ?>" >
                </div>
                <div class="form-row">
                    <input type="text" name="lname" id="lname" class="input-text" value="<?= $currentUser->getLastName() ?>" >
                </div>
            </div>
            <div class="form-row-total">
                <div class="form-row">
                    <input type="date" class="input-text" id="dateSign" name="date" value="<?= date('Y-m-d', strtotime($currentUser->getBirthday())) ?>">
                </div>
                <div class="form-row">
                    <input type="text" id="phoneSing" class="input-text"  name="phone" value="<?= $currentUser->getPhone() ?>">
                </div>
            </div>

            (Optionally, you can change your password)
            <div class="form-row-total">
                <div class="form-row">
                    <input type="password" name="password" id="password" class="input-text" placeholder="New password">
                </div>
                <div class="form-row">
                    <input type="password" name="password2" id="password2" class="input-text" placeholder="Comfirm your new password">
                </div>
            </div>
            <div class="form-row-last">
                <input type="submit" name="modify" class="register" value="Modify">
            </div>
        </form>
    </div>
</div>

<?php

if(isset($_POST['modify'])) {
    echo '<script language="javascript">';
    echo 'alert("' . $messageResponse . '")';
    echo '</script>';
}

include_once('templates/footer.template.php');
?>