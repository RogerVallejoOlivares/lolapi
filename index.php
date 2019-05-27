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
    $messageResponse = "";

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
         } else {
             $messageResponse = 'incorrect mail or password';
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
                $messageResponse = 'provided passwords dont match';

            }elseif (User::userExists($email)) {
                $messageResponse = 'the user already exists';

            }else{
                $user = User::register($name, $lastName, $email, $pwd, $phone, $birthDay);
                if($user === FALSE) {
                    $messageResponse = 'error creating user';
                }else{
                    $messageResponse = 'user registered';
                }
            }

        }
    }
    
?>
    <section class="page-section" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">League of Teams</h2>
                    <h3 class="section-subheading text-muted">Become the greatest manager</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
          </span>
                    <h4 class="service-heading">Compete</h4>
                    <p class="text-muted">Compete with others managers for gold and ELO, and reach the top to become the greatest manager.</p>
                </div>
                <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
          </span>
                    <h4 class="service-heading">Market</h4>
                    <p class="text-muted">Buy and sell players or equipment to improve your team and make it powerfull</p>
                </div>
                <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-chalkboard-teacher fa-stack-1x fa-inverse"></i>
          </span>
                    <h4 class="service-heading">Lead</h4>
                    <p class="text-muted">Lead your team, organize their positions and take decisions to win games</p>
                </div>
            </div>
        </div>
    </section>
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
                <form id="registerUser" method="post">
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
                                <input type="date" class="form-control" id="dateSign" name="date" placeholder="dd/mm/yyyy">
                            </div>
                            <div class="form-group">
                                <label for="pwdSign">Password</label>
                                <input type="password" class="form-control" id="pwdSign" name="pwd" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd2Sign">Password</label>
                                <input  type="password" class="form-control" id="pwd2Sign" name="pwd2" required>
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

    if(isset($_POST['logIn']) || isset($_POST['signUp'])) {
        echo '<script language="javascript">';
        echo 'alert("' . $messageResponse . '")';
        echo '</script>';
    }

    include_once('templates/footer.template.php');

?>