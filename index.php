<?php
/**
 * Created by PhpStorm.
 * User: matalords
 * Date: 17/05/2019
 * Time: 08:55
 */

if(!isset($_SESSION)) {
    session_start();
}

$_SESSION['current_page'] = 'index';

include_once('templates/imports.template.php');

include_once('templates/navbarPreUsers.template.php');

include_once('templates/header.template.php');

if($_POST['logIn']){
    //var_dump($_POST);
}
?>


    <!-- Modal Log In -->
    <div id="logIn" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container modal-header bg-lot">
                    <h4 class="modal-title text-white">Log In</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="index.php">
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="mailLogIn">Email</label>
                                <input type="email" class="form-control" id="mailLogIn" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="pwdLogIn">Password</label>
                                <input type="password" class="form-control" id="pwdLogIn" name="pwd" required>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="modal-footer">
                            <input type="submit" class="btn bg-lot" name="logIn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sign Up -->
    <div id="signUp" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container modal-header bg-lot">
                    <h4 class="modal-title text-white">Sign Up</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="nameSign">Name</label>
                                <input type="text" class="form-control" id="nameSign" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="lNameSign">Lastname</label>
                                <input type="text" class="form-control" id="lNameSign" name="lName">
                            </div>
                            <div class="form-group">
                                <label for="emailSign">Email</label>
                                <input type="email" class="form-control" id="emailSign" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phoneSing">Phone</label>
                                <input type="text" class="form-control" id="phoneSing" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="dateSign">date of birth</label>
                                <input type="date" class="form-control" id="dateSign" name="date">
                            </div>
                            <div class="form-group">
                                <label for="pwdSign">Password</label>
                                <input type="password" class="form-control" id="pwdLogIn" name="pwd" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd2Sign">Password</label>
                                <input type="password" class="form-control" id="pwd2Sign" name="pwd2" required>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="modal-footer">
                            <input type="submit" class="btn bg-lot" name="signUp">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php

    include_once('templates/footer.template.php');

?>