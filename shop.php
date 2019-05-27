<?php
/**
 * shop
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

$_SESSION['current_page'] = 'shop';

include_once('templates/imports.template.php');
include_once('templates/navbarUsers.template.php');

?>
    <section class="formSettings">
        <div class="container">
            <div class="row" id="navUserMainPage">
                <div class="col-lg-3 col-3">
                </div>
                <div class="col-lg-6 col-6 text-center">
                    <h2 class="section-heading text-uppercase text-white"><?= $currentUser->getName() ?></h2>
                </div>
                <div class="col-lg-3 col-3">
                    <h3 class="text-warning"> <?= $currentUser->getGold() ?>
                        <span class="fa-stack">
                        <i class="fas fa-coins fa-stack-1x fa-inverse text-warning"></i>
                    </span>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card lowMarginBtm">
                        <div class="card-header panelTittle text-center">
                            <h3 class="">Players</h3>
                        </div>
                        <div class="card-body text-center bg-teamPanel" >
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-hover lowMarginTop lowMarginBtm">
                                        <thead>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Value</th>
                                        <th>Price</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><button class="btn btn-primary">Buy</button></td>
                                            <td>player1</td>
                                            <td>Top</td>
                                            <td>2.4</td>
                                            <td>120</td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn btn-primary">Buy</button></td>
                                            <td>player1</td>
                                            <td>supplier</td>
                                            <td>3.5</td>
                                            <td>200</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" align="center"> <!-- Packs de jugadores y equipamientos aleatorios (¿mejor ponerlo encima del mercado?)-->
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-lot">Pack Low ELO players</h5>
                            <h6 class="card-subtitle mb-2 text-warning">1000
                                <span class="fa-stack">
                                    <i class="fas fa-coins fa-stack-1x fa-inverse text-warning"></i>
                                </span></h6>
                            <p class="card-text">Three players unranked to silver and equipment, at least one Bronze</p>
                            <form method="post">
                                <input type="submit" class="btn btn-primary" name="lowEloPack" value="Buy">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-lot">Pack mid ELO players</h5>
                            <h6 class="card-subtitle mb-2 text-warning">4000
                                <span class="fa-stack">
                                    <i class="fas fa-coins fa-stack-1x fa-inverse text-warning"></i>
                                </span></h6>
                            <p class="card-text">Three players gold to diamond and equipment, at least one platinum</p>
                            <form method="post">
                                <input type="submit" class="btn btn-primary" name="lowEloPack" value="Buy">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-lot">Pack high ELO players</h5>
                            <h6 class="card-subtitle mb-2 text-warning">10000
                                <span class="fa-stack">
                                    <i class="fas fa-coins fa-stack-1x fa-inverse text-warning"></i>
                                </span></h6>
                            <p class="card-text">Three players master to challenger and equipment, at least one grandmaster</p>
                            <form method="post">
                                <input type="submit" class="btn btn-primary" name="lowEloPack" value="Buy">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

include_once('templates/footer.template.php');

?>