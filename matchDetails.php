<?php
/**
 * Created by PhpStorm.
 * User: matalords
 * Date: 20/05/2019
 * Time: 12:17
 */

require __DIR__ . '/inc.config.php';

?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body class="container">
    <?php
    if(!isset($_POST['game'])) { ?>
        <form method="POST">
            <input type="text" name="gameId"/>
            <input type="submit" name="game" value="Search"/>
        </form>
        <?php
    } else {
        try {
            $game = $api->getMatch($_POST['gameId']);
        }
        catch (Exception $ex)
        {
            die("Error".$ex->getCode());
        }

        ?>
        <p class="lead">Fetching data for summoner <code><?=$_POST['gameId']?></code>.</p>
        <table class="table">
            <thead>
            <tr>
                <th>Champion</th>
                <th>Kills</th>
                <th>Deaths</th>
                <th>Assists</th>
                <th>kda</th>
                <th>Win?</th>
                <th>Damage</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($game->participants as $player){
                $stats = $player->stats;
                $kda = ($stats->kills + $stats->assists)/$stats->deaths;
                if($kda == "INF"){
                    $kda = $stats->kills + $stats->assists;
                }
                ?>
                <tr>
                    <td><?=$player->championId?></td>
                    <td><?=$stats->kills?></td>
                    <td><?=$stats->deaths?></td>
                    <td><?=$stats->assists?></td>
                    <td><?=$kda?></td>
                    <td><?=$stats->win?></td>
                    <td><?=$stats->totalDamageDealt?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
    }
    ?>
    </body>
</html>