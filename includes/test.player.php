<?php

    require('inc.player.php');
    
    //$player = new Player(1);
    //print_r($player);
    
    //$players = Player::getAllPlayers();
    //print_r($players);
    
    
    
?>

<style>
    table {
        margin: 0px auto;
    }
    
    td {
        width: 100px; 
        height: 25px;
        text-align: center; 
        vertical-align: middle;
    }
</style>

<table>
    <tr>
        <th>Name</th>
        <th>KDA</th>
        <th>Tier</th>
        <th>Division</th>        
        <th><b>Value</bthtd>
    </tr>
    <?php
        $players = Player::getAllPlayers();
        foreach($players as $p) {
            echo '<tr>';
            echo '<td>'.$p->getName().'</td>';
            echo '<td>'.$p->getKda().'</td>';
            echo '<td>'.$p->getLeagueTierId().' ('.$p->getLeagueTierName().')</td>';
            echo '<td>'.$p->getLeagueDivisionNumber().' </td>';            
            echo '<td><b>'.$p->getValue().'</b></td>';
            echo '</tr>';
        }
    ?>
</table>