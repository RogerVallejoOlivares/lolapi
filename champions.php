<?php
  /**
   *  This example shows how to fetch current champion information
   *    for all champions.
   */
  //  Include init file
  require __DIR__ . '/inc.config.php';
  use RiotAPI\DataDragonAPI\DataDragonAPI;
  //  Make a call to LeagueAPI
  $champs = DataDragonAPI::getStaticChampions()['data'];
  //print_r($champs);
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body class="container">
		<p class="lead">Fetching champion data.</p>

		<table class="table">
			<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Title</th>
				<th>Blurb</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($champs as $ch): ?>
				<tr>
					<td><?=$ch['key']?></td>
					<td><?=$ch['name']?></td>
					<td><?=$ch['title']?></td>
					<td><?=$ch['blurb']?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</body>
</html>
