<?php
    /**
     * Created by PhpStorm.
     * User: matalords
     * Date: 17/05/2019
     * Time: 08:55
     */

    include('inc.config.php');
    include(CWD.'/includes/inc.user.php');

    if(!isset($_SESSION)) {
        @session_start();
    }

    $_SESSION['current_page'] = 'index';

    include_once('templates/imports.template.php');
    
    $currentUser = User::getCurrentUser();
    if($currentUser !== FALSE && $currentUser->isLogged()) {
        include_once('templates/navbarUsers.template.php');        
    } else {
        include_once('templates/navbarPreUsers.template.php');
    }
    
    include_once('templates/header.template.php');
    
    $correctLoginPage = 'mainPage.php';

    if(isset($_GET['logout'])) {
        echo 'logout';
        if($currentUser !== FALSE) {
            $currentUser->logout();
            header('Location: index.php');
        }
    }
    
    if(isset($_POST['logIn'])){
         $email = $_POST['email'];
         $pwd = $_POST['pwd'];
         
         $user = new User($email);
         $login = $user->login($pwd);
         
         if($login) {
             @header('Location: '.$correctLoginPage);
             echo 'logging...';
             exit();
         } else {
             echo 'incorrect account or password';
             exit();
         }
    }

    if(isset($_POST['signUp'])) {
        $name = $_POST['name'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $birthDay = $_POST['date'];
        $pwd = $_POST['pwd'];
        $pwd2 = $_POST['pwd2'];
        
        if(
            isset($name) && isset($lastName) && isset($email) && 
            isset($phone) && isset($birthDay) && isset($pwd) &&
            isset($pwd2)
        ) {
            if($pwd != $pwd2) {
                echo 'provided passwords dont match';
                exit();
            }
            
            if(User::exists($email)) {
                echo 'the user already exists';
                exit();
            }
            
            $user = User::register($name, $lastName, $email, $pwd, $phone, $birthDay);
            if($user !== FALSE) {
                echo 'error creating user';
                exit();
            }
            
            //header('Location: mainPage.php');
            echo 'user registered';
            exit();
        }
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