<?php
/**
 *  This example shows how to fetch champion mastery for given
 *    summoner ID and champion ID.
 */

//  Include init file
require __DIR__ . "/../_init.php";

$summoner = 30904166;
$id = 61;

//  Make a call to LeagueAPI
$m = $api->getChampionMastery($summoner, $id);

?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body class="container">
		<p class="lead">Fetching mastery data for summoner with SummonerID: <code><?=$summoner?></code> and champion with ChampionID: <code><?=$id?></code>.</p>

		<table class="table">
			<thead>
			<tr>
				<th>Champion ID</th>
				<th>Mastery level</th>
				<th>Mastery points</th>
				<th>Chest granted?</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><?=$m->championId?></td>
				<td><?=$m->championLevel?></td>
				<td><?=$m->championPoints?></td>
				<td><?=$m->chestGranted ? 'Yes' : 'No'?></td>
			</tr>
			</tbody>
		</table>
	</body>
</html>
