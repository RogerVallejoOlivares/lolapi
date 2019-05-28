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

$positions = Array('Top', 'Jungle', 'Mid', 'Adc', 'Support');

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

if(isset($_POST['submitSquad'])) {
    foreach($positions as $position) {
        $alignedCardId = (int) $_POST['aligned'.$position.'CardId'];
        
        $cards = $currentUser->getCardsByPosition($position);
        foreach($cards as $card) {
            if($card->getId() == $alignedCardId) {
                if(!$card->isSample() && $card->getContractDaysLeft() <= 0) {
                    echo "Your card '".$card->getPlayer()->getName()."' don't have enought contract days!";
                } else {                
                    $card->setAligned(true);
                }
            } else {             
                $card->setAligned(false);
            }
        }
    }
}

?>

    <section class="formSettings">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-12">
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
                                            <th>League division</th>
                                            <th>Contract Days</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $cards = $currentUser->getCards();
                                            foreach($cards as $card) {
                                                
                                                echo '
                                                    <form method="POST">
                                                        <input type="hidden" name="cardId" value="'.$card->getId().'"/>
                                                        <tr>';
                                                if($card->isAligned()) {
                                                    echo '<td><button class="btn btn-info"/>Aligned</button></td>';
                                                } else {
                                                    if($card->isSample()) {
                                                        echo '<td><button class="btn btn-info"/>Sample</button></td>';
                                                    } else {
                                                        if($card->isInMarket()) {
                                                            echo '<td><input type="submit" name="cancel" value="Cancel" class="btn btn-danger"/></td>';
                                                        } else {
                                                            echo '<td><input type="submit" name="sell" value="Sell" class="btn btn-danger"/></td>';
                                                        }
                                                    }
                                                }
                                                
                                                $contractDays = $card->getContractDaysLeft();
                                                if($card->isSample()) {
                                                    $contractDays = 'Unlimited';
                                                }
                                                
                                                echo '
                                                        <td>'.$card->getPlayer()->getName().'</td>
                                                        <td>'.$card->getPosition().'</td>
                                                        <td>'.$card->getPlayer()->getValue().'</td>
                                                        <td>'.$card->getPlayer()->getLeagueTierName().' '.$card->getPlayer()->getLeagueDivisionName().'</td>
                                                        <td>'.$contractDays.'</td>
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

                <div class="col-xl-4 offset-xl-0 offset-md-3 col-6">
                    <div class="card lowMarginBtm">
                        <div class="card-header panelTittle text-center">
                            <h3 class="">Squad</h3>
                        </div>
                        <div class="container-fluid bg-teamPanel text-center ">
                            <br>
                            <form class="lowMarginTop" method="post">
                                <?php                                    
                                    foreach($positions as $position) {
                                        $alignedCard = $currentUser->getAlignedCardInPosition($position);
                                        if($alignedCard === FALSE) {
                                            $alignedCard = Card::getSampleCardByPosition($currentUser, $position);
                                            $alignedCard->setAligned(true);
                                        }
                                        
                                        $cardsInPosition = $currentUser->getCardsByPosition($position);
                                        
                                        echo '
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label">'.$position.'</label>
                                                <div class="col-sm-6">
                                                    <select name="aligned'.$position.'CardId" class="browser-default custom-select">                                            
                                                        <option value="'.$alignedCard->getId().'">'.$alignedCard->getPlayer()->getName().'</option>';
                                        foreach($cardsInPosition as $card) {
                                            if($card->isAligned() || $card->isInMarket()) {
                                                continue;
                                            }
                                            
                                            echo '<option value="'.$card->getId().'">'.$card->getPlayer()->getName().'</option>';
                                        }
                                       
                                        echo '      </select>
                                                 </div>
                                            </div>';      
                                    }
                                ?>

                                <input type="submit" name="submitSquad" class="btn bg-lot lowMarginBtm" value="Submit Squad"/>
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
