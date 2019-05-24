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
    
?>

    <section class="page-section masthead" id="mainMenu">
        <div class="container">
            <div class="row" id="navUserMainPage">
                <div class="col-lg-3 col-3">
                    <h3 class="text-warning"> 1234
                        <span class="fa-stack">
                        <i class="fas fa-coins fa-stack-1x text-warning"></i>
                    </span>
                    </h3>
                </div>
                <div class="col-lg-6 col-6 text-center">
                    <h2 class="section-heading text-uppercase">Matalords</h2>
                </div>
                <div class="col-lg-3 col-3">
                    <h3 class="text-lot"> 1234
                        <span class="fa-stack">
                        <i class="fas fa-trophy fa-stack-1x fa-inverse text-lot"></i>
                    </span>
                    </h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <h3 class="service-heading">Match List</h3>

                    <ul class="list-group"> <!-- list historic games -->
                        <li class="list-group-item matchListGameWin">Mapilol</li>
                        <li class="list-group-item matchListGameLost">Inferno</li>
                        <li class="list-group-item matchListGameLost">Tureka</li>
                        <li class="list-group-item matchListGameWin">NereGr</li>
                        <li class="list-group-item matchListGameLost">Asis</li>
                    </ul>

                </div>
                <div class="col-md-4 ">
                    <div class="row" style="height: 100%;">
                        <div class="col-md-2 col-3"></div>
                        <div class="col-8">
                            <table id="tableSearchGame">
                                <tbody>
                                <tr>
                                    <td class="align-middle"> <!-- search game -->
                                        <h3 class="service-heading">Search Game</h3>
                                        <a class="fa-stack fa-4x textShadowButton align-middle " href="#">
                                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                            <i class="fas fa-chess fa-stack-1x fa-inverse"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="service-heading">Team</h3> <!-- list aligned players -->
                    <table class="table table-hover table-dark tablePlayers">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Value</th>
                            <th scope="col">Contracts</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>mapilol</td>
                                <td>3.9</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>FlapyFish</td>
                                <td>3.0</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>Adry2016</td>
                                <td>2.8</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Naroi</td>
                                <td>3.2</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td>Karasu13</td>
                                <td>5.4</td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

<?php

    include_once('templates/footer.template.php');

?>