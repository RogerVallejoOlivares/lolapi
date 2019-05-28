<?php

require(__DIR__.'/../inc.config.php');

class Match {
    private $current_user;
    private $enemy_user;
    private $date;
    private $winnerUser;
    
    public static $db;
    
    public function __construct($current_user, $enemy_user, $winnerUser = FALSE, $date = FALSE) {
        $this->current_user = $current_user;
        $this->enemy_user = $enemy_user;
        $this->winnerUser = $winnerUser;
        $this->date = $date;
    }
    
    public static function getUserWithNearestElo($current_elo, $from_id) {
        // SELECT * FROM manager WHERE idManager != 1 ORDER BY abs(elo - $current_elo) LIMIT 1
        
        self::$db->orderBy('abs(elo - '.$current_elo.')', 'ASC');
        self::$db->where('idManager', $from_id, '!=');
        $result = self::$db->getOne('manager');
     
        if($result !== FALSE) {
            $enemy_user_name = $result['email'];
            if(User::userExists($enemy_user_name)) {
                $enemy_user = new User($enemy_user_name);
                
                return $enemy_user;
            }
        }
        
        return FALSE;
    }
    
    public static function search($current_user) {
        if($current_user === FALSE) {
            return FALSE;        
        }
        
        $current_user_elo = $current_user->getElo();
        $enemy_user = self::getUserWithNearestElo($current_user_elo, $current_user->getId());  
        if($enemy_user === FALSE) {
            return FALSE;
        }
        
        $match = new Match($current_user, $enemy_user);
        
        return $match;
    }
    
    public static function getMatchHistory($user, $matchCount = 5) {
        $matchHistory = Array();
        
        self::$db->orderBy('date', 'ASC');
        self::$db->where('idManager1', $user->getId());
        $matches = self::$db->get('match', $matchCount);
        
        foreach($matches as $match) {
            $currentUser = new User($match['idManager1']);
            $enemyUser = new User($match['idManager2']);
            $winnerUser = ($match['winner'] == $match['idManager1']) ? $currentUser : $enemyUser;
            $date = $match['date'];
            
            $m = new Match($currentUser, $enemyUser, $winnerUser, $date);
            array_push($matchHistory, $m);
        }
        
        return $matchHistory;
    }


    public function getCurrentUser() {
        return ($this->current_user);
    }
    
    public function getEnemyUser() {
        return ($this->enemy_user);
    }    
    
    public function getWinnerUser() {
        return $this->winnerUser;
    }
    
    public function getDate() {
        return $this->date;
    }
}

if (!isset(Match::$db)) {
    Match::$db = MysqliDb::getInstance(); // this is a little hack to initialize a static variable
}

?>
