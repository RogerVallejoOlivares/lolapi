<?php

    require('inc.player.php');
    
    //$player = new Player(1);
    //print_r($player);
    
    $players = Player::getAllPlayers();
    //print_r($players);
    
    foreach($players as $p) {
        //print('player '.$p->getName().' is in division number '.Player::getDivisionNumberByName($p->getLeagueDivisionName()).PHP_EOL);
        print('player '.$p->getName().' has a value of '.$p->getValue().PHP_EOL);
    }
    
?>

