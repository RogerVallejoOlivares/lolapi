<?php

    include("inc.user.php");
    //include("inc.player.php");
    include("inc.card.php");
    
    $users = User::getAllUsers();
    foreach($users as $user) {
        $samplePlayers = Array('Top', 'Jungle', 'Mid', 'Adc', 'Support');
        foreach($samplePlayers as $sample) {            
            $player = Player::getPlayerByName($sample.' Sample');            
            
            $card = Card::createCard($user, $player);
            $card->setPosition(strtolower($sample));
            print('$card->setPosition(strtolower('.$sample.'));'.PHP_EOL);
        }
    }

?>
