<?php
    /**
     * shop
     */

    if(!isset($_SESSION)) {
        @session_start();
    }

    include('inc.config.php');

    $returnUrl = 'index.php';
    $currentUser = User::getCurrentUser();
    $messageResponse = "";

    if($currentUser === FALSE || ($currentUser !== FALSE && !$currentUser->isLogged())) {
        @header('Location: '.$returnUrl);
        exit();
    }

    $_SESSION['current_page'] = 'shop';

    include_once('templates/imports.template.php');
    include_once('templates/navbarUsers.template.php');
   
    $newCards = Array();
    $players = Array();
    $contracts = 0;
    if(isset($_GET['id'])) {
        $boxId = (int) $_GET['id'];
        
        $minContracts = 0;
        $maxContracts = 0;
        $price = 0;
        $players = Array();
        
        if($boxId == 1) {
            $minContracts = 3;
            $maxContracts = 10;
            $price = 500;
            
            $numPlayers = 3;
            while(count($players) != $numPlayers) {
                $tierId = rand(1, 4);
                $randomPlayer = Player::getRandomPlayerByTierId($tierId);                
                
                if($randomPlayer === FALSE) {
                    continue;
                }
                
                if($randomPlayer->isSample()) {
                    continue;
                }
                
                array_push($players, $randomPlayer);
            }
                    
        } else if($boxId == 2) {
            $minContracts = 15;
            $maxContracts = 25;
            $price = 1000;
            
            $numPlayers = 3;
        
            while(count($players) != $numPlayers) {
                $tierId = rand(5, 7);
                $randomPlayer = Player::getRandomPlayerByTierId($tierId);                
                
                if($randomPlayer === FALSE) {
                    break;
                }
                
                if($randomPlayer->isSample()) {
                    continue;
                }
                
                array_push($players, $randomPlayer);
            }
        
        } else if($boxId == 3) {
            $minContracts = 35;
            $maxContracts = 50;
            $price = 4000;
            
            $numPlayers = 3;            
        
            while(count($players) != $numPlayers) {
                $tierId = rand(8, 10);
                $randomPlayer = Player::getRandomPlayerByTierId($tierId);                
                
                if($randomPlayer === FALSE) {
                    break;
                }
                
                if($randomPlayer->isSample()) {
                    continue;
                }
                
                array_push($players, $randomPlayer);
            }
        }
        
        if($currentUser->getGold() < $price) {
            $messageResponse = "You don't have enough money!";
        } else {        
            $contracts = rand($minContracts, $maxContracts);
            $positions = Array('top', 'jungle', 'mid', 'adc', 'support');
            
            foreach($players as $player) {
                if($player === FALSE) {
                    $messageResponse = 'ERROR PLAYER<br>';
                    print_r($player);
                    continue;
                }
                
                $card = Card::createCard($currentUser, $player);
                $card->setPosition($positions[array_rand($positions)]);
                array_push($newCards, $card);
            }

            $cards = $currentUser->getCards();            
            foreach($cards as $card) {
                if(!$card->isSample()) {
                    $card->setContractDaysLeft($card->getContractDaysLeft() + $contracts);
                }
            }                        
 
            $currentUser->setGold($currentUser->getGold() - $price);
        }
    } else {
        //@header('Location: shop.php');
    }

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
                            <h3 class="">Loot</h3>
                        </div>
                        <div class="card-body text-center bg-teamPanel" >
                            <div class="row">
                                <div class="col-12"> 
                                    You won <?= $contracts ?> contracts for all of your players!
                                    <table class="table table-hover lowMarginTop lowMarginBtm">
                                        <thead>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Value</th>
                                        </thead>
                                        <tbody>
                                        <?php

                                            foreach($newCards as $card) {
                                                if($card === FALSE) {
                                                    continue;
                                                }
                                                
                                                echo '<tr>';
                                                echo '  <td>'.$card->getPlayer()->getName().'</td>';
                                                echo '  <td>'.$card->getPosition().'</td>';
                                                echo '  <td>'.$card->getPlayer()->getValue().'</td>';
                                                echo '</tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" align="center"> <!-- Packs de jugadores y equipamientos aleatorios (¿mejor ponerlo encima del mercado?)-->
                <div class="col-md-4 col-12 lowMarginBtm">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-lot">Pack Low ELO players</h5>
                            <h6 class="card-subtitle mb-2 text-warning">500
                                <span class="fa-stack">
                                    <i class="fas fa-coins fa-stack-1x fa-inverse text-warning"></i>
                                </span></h6>
                            <p class="card-text">Three players unranked to silver and equipment, at least one Bronze</p>
                            <a href="box.php?id=1" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12 lowMarginBtm">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-lot">Pack mid ELO players</h5>
                            <h6 class="card-subtitle mb-2 text-warning">1000
                                <span class="fa-stack">
                                    <i class="fas fa-coins fa-stack-1x fa-inverse text-warning"></i>
                                </span></h6>
                            <p class="card-text">Three players gold to diamond and equipment, at least one platinum</p>
                            <a href="box.php?id=2" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12 midMarginBtm">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title text-lot">Pack high ELO players</h5>
                            <h6 class="card-subtitle mb-2 text-warning">4000
                                <span class="fa-stack">
                                    <i class="fas fa-coins fa-stack-1x fa-inverse text-warning"></i>
                                </span></h6>
                            <p class="card-text">Three players master to challenger and equipment, at least one grandmaster</p>
                            <a href="box.php?id=3" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

if(isset($_GET['id']) && !empty($messageResponse)) {
    echo '<script language="javascript">';
    echo 'alert("' . $messageResponse . '")';
    echo '</script>';
}

include_once('templates/footer.template.php');

?>