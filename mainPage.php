<?php
/**
 * Main page for Users
 */

    if(!isset($_SESSION)) {
        @session_start();
    }
    
    include('inc.config.php');

    $returnUrl = 'index.php';
    $currentUser = User::getCurrentUser();
    $messageResponse = '';

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
                    <h3 class="text-warning"> <?= $currentUser->getGold() ?>
                        <span class="fa-stack">
                        <i class="fas fa-coins fa-stack-1x text-warning"></i>
                    </span>
                    </h3>
                </div>
                <div class="col-lg-6 col-6 text-center">
                    <h2 class="section-heading text-uppercase"><?= $currentUser->getName() ?></h2>
                </div>
                <div class="col-lg-3 col-3">
                    <h3 class="text-lot"> <?= $currentUser->getElo() ?>
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
                        <?php
                            $matches = Match::getMatchHistory($currentUser);
                            if(count($matches) > 0) {
                                foreach($matches as $match) {
                                    if($match->isDraw()) {
                                        echo '<li class="list-group-item matchListGameLost">'.$match->getEnemyUser()->getName().'</li>';
                                    } else {
                                        if($match->isWinner()) {
                                            echo '<li class="list-group-item matchListGameWin">'.$match->getEnemyUser()->getName().'</li>';
                                        } else {
                                            echo '<li class="list-group-item matchListGameLost">'.$match->getEnemyUser()->getName().'</li>';
                                        }
                                    }
                                }
                            } else {
                                echo '<li class="list-group-item matchListGameLost">There are no matches to show!</li>';
                            }
                        ?>
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
                                        <form id="formSearchGame" method="post">
                                            <a id="submitSearchGame" class="fa-stack fa-4x textShadowButton align-middle" name='searchGame' href='matchPage.php'>
                                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                                <i class="fas fa-chess fa-stack-1x fa-inverse"></i>
                                            </a>
                                        </form>
                                        <?php
                                            if(isset($_POST['searchGame'])) {
                                                $match = Match::search($currentUser);
                                                if ($match === FALSE) {
                                                    $messageResponse = 'There are no enemies to fight!';
                                                } else {
                                                    $enemy_user = $match->getEnemyUser();
                                                    if ($enemy_user === FALSE) {
                                                        $messageResponse = 'An unexpected error ocurred while searching for a fight.';
                                                    } else {
                                                        $messageResponse = 'Your enemy is ' . $enemy_user->getEmail();
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="service-heading">Team</h3> <!-- list aligned players -->
                    <?php
                    $cards = Card::getAllCards($currentUser);
                    if($cards === FALSE) {
                        echo 'There are no players on your team';
                    } else { ?>
                    <table class="table table-hover table-dark tablePlayers">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Value</th>
                            <th scope="col">Contracts</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                           foreach ($cards as $card){

                               if(!User::compare($currentUser, $card->getUser()) || $card->isAligned() === 0) {
                                   continue;
                               }

                               echo '
                                <tr>
                                    <td>'.$card->getPlayer()->getName().'</td>
                                    <td>'.$card->getPosition().'</td>
                                    <td>'.$card->getPlayer()->getValue().'</td>
                                    <td>'.$card->getContractDaysLeft().'</td>
                                </tr>
                                ';
                           }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

<?php

    if(isset($_POST['searchGame'])) {
        echo '<script language="javascript">';
        echo 'alert("' . $messageResponse . '")';
        echo '</script>';
    }

    include_once('templates/footer.template.php');

?>