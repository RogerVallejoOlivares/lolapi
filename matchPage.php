<?php
    /**
     * Match page
     */

    if(!isset($_SESSION)) {
        @session_start();
    }

    include('inc.config.php');

    $returnUrl = 'index.php';
    $currentUser = User::getCurrentUser();

    if($currentUser === FALSE || ($currentUser !== FALSE && !$currentUser->isLogged())) {
        @header('Location: '.$returnUrl);
        exit();
    }

    $_SESSION['current_page'] = 'main';

    include_once('templates/imports.template.php');
    include_once('templates/navbarUsers.template.php');

    $match = FALSE;
    if(!isset($_GET['id'])) {
        echo 'No player id';
    } else {
        $id = (int) $_GET['id'];
        
        if($id == $currentUser->getId()) {
            echo "You can't match yourself!";
        } else {
            $enemyUser = User::getUserById($id);
            if($enemyUser === FALSE) {
                echo "An user with this ID don't exist";
            } else {
                $match = new Match($currentUser, $enemyUser);
                if(!$match->do()) {
                    echo 'Error while calculating match result';
                } else {
                    if($match->isDraw()) {
                        $match->getCurrentUser()->setElo($match->getCurrentUser()->getElo() + 1);
                        $match->getCurrentUser()->setGold($match->getCurrentUser()->getGold() + 10);
                    } else {
                        if($match->isWinner()) {
                            $match->getCurrentUser()->setElo($match->getCurrentUser()->getElo() + 3);
                            $match->getCurrentUser()->setGold($match->getCurrentUser()->getGold() + 30);
                        }
                    }           
                }
            }
        }
    }

?>

<section class="formSettings">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header cardTittle text-center">
                        <h4 class="">Summary</h4>
                    </div>
                    <div class="card-body text-center" id="cardMap">
                        <div class="row">
                            <div class="col-lg-5 col-6">
                                <?php
                                    if($match !== FALSE) {
                                        if($match->isDraw()) {
                                            echo '<h1 class="nameMatch text-info">'.$match->getCurrentUser()->getName().'</h1>';
                                            echo '<h3 class="midMarginBtm">draw</h3>';
                                        } else {
                                            if($match->isWinner()) {
                                                echo '<h1 class="nameMatch text-primary">'.$match->getCurrentUser()->getName().'</h1>';
                                                echo '<h3 class="midMarginBtm">winner</h3>';
                                            } else {
                                                echo '<h1 class="nameMatch text-danger">'.$match->getCurrentUser()->getName().'</h1>';
                                                echo '<h3 class="midMarginBtm">loser</h3>';
                                            }
                                        }
                                    }
                                ?> 
                            </div>
                            <div class="col-lg-5 col-6 offset-lg-2">
                                <?php
                                    if($match !== FALSE) {
                                        if($match->isDraw()) {
                                            echo '<h1 class="nameMatch text-info">'.$match->getEnemyUser()->getName().'</h1>';
                                            echo '<h3 class="midMarginBtm">draw</h3>';
                                        } else {
                                            if(!$match->isWinner()) {
                                                echo '<h1 class="nameMatch text-primary">'.$match->getEnemyUser()->getName().'</h1>';
                                                echo '<h3 class="midMarginBtm">winner</h3>';
                                            } else {
                                                echo '<h1 class="nameMatch text-danger">'.$match->getEnemyUser()->getName().'</h1>';
                                                echo '<h3 class="midMarginBtm">loser</h3>';
                                            }
                                        }
                                    }
                                ?>                                 
                            </div>
                        </div>
                        <a href="#detailsMatch" class="btn bg-lot lowMarginBtm" >Go details</a>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card" id="detailsMatch">
                    <div class="card-header cardTittle text-center">
                        <h4 class="">Details</h4>
                    </div>
                    <div class="card-body text-center" id="">
                        <div class="row lowMarginBtm">
                            <div class="col-lg-5 col-6">
                                <?php
                                    if($match !== FALSE) {
                                        if($match->isWinner()) {
                                            echo '<h3 class="text-primary lowMarginBtm">'.$match->getCurrentUser()->getName().'</h3>';
                                        } else {
                                            echo '<h3 class="text-danger lowMarginBtm">'.$match->getCurrentUser()->getName().'</h3>';
                                        }
                                    }
                                ?>
                                <table class="table table-hover lowMarginBtm">
                                    <tbody>
                                        <?php
                                            $positions = Array('top', 'jungle', 'mid', 'adc', 'support');
                                            $currentTotalValue = 0;
                                            foreach($positions as $position) {
                                                $currentUserAligned = $match->getCurrentUser()->getAlignedCardInPosition($position);
                                                $currentTotalValue = $currentTotalValue + $currentUserAligned->getPlayer()->getValue();
                                                
                                                echo '<tr>';
                                                echo '  <td>'.$currentUserAligned->getPlayer()->getName().'</td>';
                                                echo '  <td>'.$currentUserAligned->getPlayer()->getValue().'</td>';
                                                echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <h4>Total: <?= $currentTotalValue ?></h4>
                            </div>
                            <div class="col-lg-5 col-6 offset-lg-2">
                                <?php
                                    if($match !== FALSE) {
                                        if(!$match->isWinner()) {
                                            echo '<h3 class="text-primary lowMarginBtm">'.$match->getEnemyUser()->getName().'</h3>';
                                        } else {
                                            echo '<h3 class="text-danger lowMarginBtm">'.$match->getEnemyUser()->getName().'</h3>';
                                        }
                                    }
                                ?>
                                <table class="table table-hover lowMarginBtm">
                                    <tbody>
                                        <?php
                                            $positions = Array('top', 'jungle', 'mid', 'adc', 'support');
                                            $enemyTotalValue = 0;
                                            foreach($positions as $position) {
                                                $ernemyUserAligned = $match->getEnemyUser()->getAlignedCardInPosition($position);
                                                $enemyTotalValue = $enemyTotalValue + $ernemyUserAligned->getPlayer()->getValue();
                                                
                                                echo '<tr>';
                                                echo '  <td>'.$ernemyUserAligned->getPlayer()->getName().'</td>';
                                                echo '  <td>'.$ernemyUserAligned->getPlayer()->getValue().'</td>';
                                                echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <h4>Total: <?= $enemyTotalValue ?></h4>
                            </div>
                        </div>
                        <?php
                            if($match !== FALSE) {
                                if($match->isDraw()) {
                                    echo '<h3>DRAW</h3>';
                                } else {
                                    echo '<h3>WINNER: '.($match->getWinnerUser()->getName()).'</h3>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

include_once('templates/footer.template.php');

?>
