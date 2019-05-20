<?php
  /**
   *  This example shows how to fetch summoner information based on summoner ID.
   */
  //  Include init file
  require __DIR__ . '/inc.config.php';

?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body class="container">
      <?php
        if(!isset($_POST['summoner'])) {
          ?>
            <form method="POST">
              <select name="searchType">
                <option name="accountId">AccountId</option>
                <option name="name">Name</option>
              </select>
              <input type="text" name="summonerId"/>
              <input type="submit" name="summoner" value="Search"/>
            </form>
          <?php
        } else {
          try
          {
            $summonerId = $_POST['summonerId'];
            $searchType = $_POST['searchType'];

            if($searchType == 'accountId') {
              $s = $api->getSummonerByAccount($summonerId);
            } else {
              $s = $api->getSummonerByName($summonerId);
            }
          }
          catch (Exception $ex)
          {
          	die("Request failed to be processed: " . $ex->getMessage());
          }

          ?>
          <p class="lead">Fetching data for summoner with <?=$searchType?>: <code><?=$summonerId?></code>.</p>

          <table class="table">
              <thead>
              <tr>
                  <th>SummonerID</th>
                  <th>AccountID</th>
                  <th>Profile icon</th>
                  <th>Summoner name</th>
                  <th>Summoner level</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td><?=$s->id?></td>
                  <td><?=$s->accountId?></td>
                  <td><?=$s->profileIconId?> <?php /*DataDragonAPI::getProfileIcon($s->profileIconId);*/ ?></td>
                  <td><?=$s->name?></td>
                  <td><?=$s->summonerLevel?></td>
              </tr>
              </tbody>
          </table>
        <?php } ?>

    </body>
</html>
