<?php
/**
 * Team page
 */

if(!isset($_SESSION)) {
    @session_start();
}

include('inc.config.php');
include(CWD.'includes/inc.user.php');

$returnUrl = 'index.php';
$currentUser = User::getCurrentUser();

if($currentUser === FALSE || ($currentUser !== FALSE && !$currentUser->isLogged())) {
    @header('Location: '.$returnUrl);
    exit();
}

$_SESSION['current_page'] = 'team';

include_once('templates/imports.template.php');
include_once('templates/navbarUsers.template.php');

if(isset($_POST['cancel'])) {
    $cardId = (int) $_POST['cardId'];
    
    if(isset($cardId)) {
        $card = new Card($cardId);
        
        if(!User::compare($card->getUser(), $currentUser)) {
            echo "You can't remove cards from market thath you don't own";
        } else {
            $card->removeFromMarket();
        }
    }
}

if(isset($_POST['sell'])) {
    $cardId = (int) $_POST['cardId'];
    
    if(isset($cardId)) {
        $card = new Card($cardId);

        if(!User::compare($card->getUser(), $currentUser)) {
            echo "You can't sell cards you don't own";
        } else {
            $card->addToMarket();
        }
    }
}

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
                                        <?php
                                            $cards = $currentUser->getCards();
                                            foreach($cards as $card) {
                                                if($card->isAligned()) {
                                                    continue;
                                                }
                                                
                                                echo '
                                                    <form method="POST">
                                                        <input type="hidden" name="cardId" value="'.$card->getId().'"/>
                                                        <tr>';
                                                if($card->isInMarket()) {
                                                    echo '<td><input type="submit" name="cancel" value="Cancel" class="btn btn-danger"/></td>';
                                                } else {
                                                    echo '<td><input type="submit" name="sell" value="Sell" class="btn btn-danger"/></td>';
                                                }
                                                
                                                echo '
                                                        <td>'.$card->getPlayer()->getName().'</td>
                                                        <td>'.$card->getPosition().'</td>
                                                        <td>'.$card->getPlayer()->getKda().'</td>
                                                        <td>'.$card->getContractDaysLeft().'</td>
                                                    </tr>
                                                </form>';
                                            }
                                        ?>
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
                                            <?php
                                                $cards = $currentUser->getCurrentCard
                                             //echo '<option value="1">player1</option>';
                                            ?>
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
                            <div class="col-12">
                                <span class="">Matalords2392</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <img class="cardImage" src="img/tint2.jpg">
                            </div>
                            <div class="col-5 cardDetailsRight">
                                <span class="">23</span><br>
                                <span class="">Jungle</span><br>
                                <span class="">4.3</span><br>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

include_once('templates/footer.template.php');

?>
