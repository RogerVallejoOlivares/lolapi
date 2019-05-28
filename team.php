<?php
/**
 * Team page
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

$_SESSION['current_page'] = 'team';

include_once('templates/imports.template.php');
include_once('templates/navbarUsers.template.php');

?>

    <section class="formSettings">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="card lowMarginBtm">
                        <div class="card-header panelTittle text-center">
                            <h3 class="">Players</h3>
                        </div>
                        <div class="card-body text-center bg-teamPanel" >
                            <div class="row">
                                <div class="col-12 ">
                                    <table class="table table-hover lowMarginTop lowMarginBtm">
                                        <thead>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Value</th>
                                            <th>Contract Days</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><button class="btn btn-danger">Sell</button></td>
                                            <td>player1</td>
                                            <td>Top</td>
                                            <td>3.5</td>
                                            <td>12</td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn btn-danger">Sell</button></td>
                                            <td>player1</td>
                                            <td>Top</td>
                                            <td>3.5</td>
                                            <td>12</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12">
                    <div class="card lowMarginBtm">
                        <div class="card-header panelTittle text-center">
                            <h3 class="">Squad</h3>
                        </div>
                        <div class="container-fluid bg-teamPanel text-center ">
                            <br>
                            <form class="lowMarginTop" method="post">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Top</label>
                                    <div class="col-sm-6">
                                        <select class="browser-default custom-select">
                                            <option value="1">player1</option>
                                            <option value="2">player2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Jungle</label>
                                    <div class="col-sm-6">
                                        <select class="browser-default custom-select">
                                            <option value="1">player1</option>
                                            <option value="2">player2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Mid</label>
                                    <div class="col-sm-6">
                                        <select class="browser-default custom-select">
                                            <option value="1">player1</option>
                                            <option value="2">player2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Adc</label>
                                    <div class="col-sm-6">
                                        <select class="browser-default custom-select">
                                            <option value="1">player1</option>
                                            <option value="2">player2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Support</label>
                                    <div class="col-sm-6">
                                        <select class="browser-default custom-select">
                                            <option value="1">player1</option>
                                            <option value="2">player2</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn bg-lot lowMarginBtm">Submit Squad</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="cardPlayer lowMarginBtm">
                    <div class="cardBody cardChallenger">
                        <div class="row">
                            <div class="col-9">
                                <span class="">Matalords2392</span>
                            </div>
                            <div class="col-3">
                                <span class="">4.3</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <span class="">Jungle</span>
                            </div>
                            <div class="col-3">
                                <span class="">23</span>
                            </div>
                        </div>
                        <img class="cardImage" src="img/tint2.jpg">
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

include_once('templates/footer.template.php');

?>