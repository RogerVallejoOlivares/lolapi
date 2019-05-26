<?php

require(__DIR__ . '/../inc.config.php');

class Player {

    private $id;
    private $kda;
    private $name;
    private $leagueTierId;
    private $leagueTierName;
    private $leagueDivisionNumber;
    private $leagueDivisionName;

    public function __construct($id) {
        $db = MysqliDb::getInstance();
        
        $db->where('idPlayer', $id);
        $result = $db->getOne('player');
        if($result) {
            $this->id = $id;
            $this->kda = $result['KDA'];
            $this->name = $result['name'];
            $this->leagueTierId = $result['leagueId'];
            $this->leagueTierName = self::getLeagueById($result['leagueId']);
            $this->leagueDivisionNumber = self::getDivisionNumberByName($result['leagueRank']);
            $this->leagueDivisionName = $result['leagueRank'];
        }
        
        return FALSE;
    }
    
    public static function getLeagueById($leagueId) {
        $db = MysqliDb::getInstance();
        $db->where('leagueid', $leagueId);
        $result = $db->getOne('league');
        if($result) {
            if(isset($result['name'])) {
                return $result['name'];
            }
        }
        
        return FALSE;
    }
    
    public static function getDivisionNumberByName($divisionName) {
        $divisionNames = Array(
          'I' => 1, 'II' => 2, 'III' => 3, 'IV' => 4, 'V' => 5  
        );
        
        if(isset($divisionNames[$divisionName])) {
            return $divisionNames[$divisionName];
        }
        
        return 0;
    }
    
    public static function getAllPlayers() {
        $db = MysqliDb::getInstance();
        $players = $db->get('player', null, 'idPlayer');
        if($players && $db->count > 0) {
            $playerList = Array();
            foreach($players as $player) {
                $p = new Player($player['idPlayer']);
                array_push($playerList, $p);
            }
            
            return $playerList;
        }
        
        return FALSE;
    } 
    
    public function getValue() {
        // this is the simple formula to know the 'power' of a player
        // will be used in fights
        
        return ($this->kda + $this->leagueDivisionNumber + $this->leagueTierId);
    }

    public function getId() {
        return $this->id;
    }

    function getKda() {
        return $this->kda;
    }

    function getName() {
        return $this->name;
    }
    function getLeagueTierId() {
        return $this->leagueTierId;
    }

    function getLeagueTierName() {
        return $this->leagueTierName;
    }

    function getLeagueDivisionNumber() {
        return $this->leagueDivisionNumber;
    }

    function getLeagueDivisionName() {
        return $this->leagueDivisionName;
    }

}

?>