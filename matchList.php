<?php
/**
 *  This example shows The matchlist of a summoner
 */


require __DIR__ . '/inc.config.php';

?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body class="container">
    <?php
        if(!isset($_POST['summoner'])) { ?>
            <form method="POST">
                <input type="text" name="summonerName"/>
                <input type="submit" name="summoner" value="Search"/>
            </form>
        <?php
        } else {
            try {
                $player = $api->getSummonerByName($_POST['summonerName']);
                $matchlist = $api->getMatchlistByAccount($player->accountId);
            }
            catch (Exception $ex)
            {
                die("Error".$ex->getCode());
            }

            ?>
            <p class="lead">Fetching data for summoner <code><?=$_POST['summonerName']?></code>.</p>

            <table class="table">
                <thead>
                <tr>
                    <th>GameId</th>
                    <th>Champion</th>
                    <th>Queue</th>
                    <th>Role</th>
                    <th>Lane</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($matchlist as $ml): ?>
                        <tr>
                            <td><?=$ml->gameId?></td>
                            <td><?=$ml->champion?></td>
                            <td><?=$ml->queue?></td>
                            <td><?=$ml->role?></td>
                            <td><?=$ml->lane?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php
            }
        ?>
    </body>
</html>