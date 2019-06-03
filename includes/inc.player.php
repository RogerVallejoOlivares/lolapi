<?php

require(__DIR__ . '/../inc.config.php');

class Player {

    private $id;
    private $kda;
    private $name;
    private $accountId;
    private $summonerId;
    private $leagueTierId;
    private $leagueTierName;
    private $leagueDivisionNumber;
    private $leagueDivisionName;
    
    public static $db;

    public function __construct($id) {
        self::$db->where('idPlayer', $id);
        $result = self::$db->getOne('player');
        if($result) {
            $this->id = $id;
            $this->kda = $result['KDA'];
            $this->name = $result['name'];
            $this->leagueTierId = $result['leagueId'];
            $this->leagueTierName = self::getLeagueById($result['leagueId']);
            $this->leagueDivisionNumber = self::getDivisionNumberByName($result['leagueRank']);
            $this->leagueDivisionName = $result['leagueRank'];
            $this->accountId = $result['accountId'];
            $this->summonerId = $result['summonerId'];
        }
        
        return FALSE;
    }
    
    public static function getLeagueById($leagueId) {
        self::$db->where('leagueid', $leagueId);
        $result = self::$db->getOne('league');
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
        $players = self::$db->get('player', null, 'idPlayer');
        if($players && self::$db->count > 0) {
            $playerList = Array();
            foreach($players as $player) {
                $p = new Player($player['idPlayer']);
                array_push($playerList, $p);
            }
            
            return $playerList;
        }
        
        return FALSE;
    } 
    
    public static function getPlayerByName($name) {
        self::$db->where('name', $name);
        $result = self::$db->getOne('player', 'idPlayer');
        if($result) {
            if(isset($result['idPlayer'])) {
                $player = new Player($result['idPlayer']);
                return $player;
            }
        }
        
        return FALSE;
    }
    
    public static function getRandomPlayerByTierId($tierId) {
        
        if($tierId < 1 || $tierId > 10) {            
            return FALSE;
        }
        
        self::$db->where('leagueId', $tierId);
        self::$db->orderBy("RAND ()");
        $result = self::$db->getOne('player');
        
        if(self::$db->count > 0) {
            if(isset($result['idPlayer'])) {
                $player = new Player($result['idPlayer']);
                return $player;
            }
        }
        
        return FALSE;
    }
            
    public function getValue() {
        // this is the simple formula to know the 'power' of a player
        // will be used in fights      
        
        $value = 0;
         
        if(false) {
            $value = ($this->kda + $this->leagueDivisionNumber + $this->leagueTierId);
        }
        
        if(false) {
            $value = $this->leagueDivisionNumber * 100;
            $value = $value / (10 - $this->leagueTierId);
            $value = $value * $this->kda;
            $value = $value;
            $value = round($value);
        }
        
        if(true) {
            $value = 0;
            $value = $value + ($this->leagueTierId * 0.65);
            $value = $value + ((4 - $this->leagueDivisionNumber) * 0.20);            
            $value = $value + ($this->kda * 0.15);
            $value = $value * 100;
            $value = round($value);
        }
        
        return $value;
    }
    
    public function getPrice() {
        // this is a simple formula to know the price of a player
        
        return round($this->getValue());
    }

    public function getId() {
        return $this->id;
    }

    public function getKda() {
        return $this->kda;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getLeagueTierId() {
        return $this->leagueTierId;
    }

    public function getLeagueTierName() {
        return $this->leagueTierName;
    }

    public function getLeagueDivisionNumber() {
        return $this->leagueDivisionNumber;
    }

    public function getLeagueDivisionName() {
        return $this->leagueDivisionName;
    }
    
    public function getAccountId() {
        return $this->accountId;
    }
    
    public function getSummonerId() {
        return $this->summonerId;
    }

    public function isSample() {
        $accountId = strtolower($this->getAccountId());
        $summonerId = strtolower($this->getSummonerId());
                
        return ($accountId == 'sample' && $summonerId == 'sample');
    }
    
}

if (!isset(Player::$db)) {
    Player::$db = MysqliDb::getInstance(); // this is a little hack to initialize a static variable
}

?>