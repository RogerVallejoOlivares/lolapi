<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once __DIR__  . "/vendor/autoload.php";

  use RiotAPI\LeagueAPI\LeagueAPI;
  use RiotAPI\LeagueAPI\Definitions\Region;

  $api = new LeagueAPI([
    LeagueAPI::SET_KEY    => 'RGAPI-f60d232e-3033-4990-9422-1132e3a23590',
    LeagueAPI::SET_REGION => Region::EUROPE_WEST,
  ]);

  use RiotAPI\DataDragonAPI\DataDragonAPI;
  use RiotAPI\DataDragonAPI\Exceptions\GeneralException;
  use RiotAPI\DataDragonAPI\Definitions\Map;

  DataDragonAPI::initByCdn();
?>
