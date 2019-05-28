<?php

include(__DIR__.'/../inc.config.php');

class Match {
    private $currentUser;
    private $enemyUser;
    private $date;
    private $winnerUser;
    
    public static $db;
    
    public function __construct($current_user, $enemy_user, $winnerUser = FALSE, $date = FALSE) {
        $this->currentUser = $current_user;
        $this->enemyUser = $enemy_user;
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
        $matches = self::$db->get('matchHistory', $matchCount);
        
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
    
    public function do() {
        $positions = Array('top', 'jungle', 'mid', 'adc', 'support');
        
        $totalCount = 0;
        $winCount = 0;
        $drawCount = 0;
        foreach($positions as $position) {
            $currentUserAligned = $this->currentUser->getAlignedCardInPosition($position);
            $enemyUserAligned = $this->enemyUser->getAlignedCardInPosition($position);
                         
            if($currentUserAligned === FALSE || $enemyUserAligned === FALSE) {
                continue;
            }
            
            if($currentUserAligned->getPlayer()->getValue() > $enemyUserAligned->getPlayer()->getValue()) {
                $winCount = $winCount + 1;
            } else if($currentUserAligned->getPlayer()->getValue() == $enemyUserAligned->getPlayer()->getValue()) {
                $drawCount = $drawCount + 1;
            }
            
            $totalCount = $totalCount + 1;
        }
        
        if($drawCount == $totalCount) {
            $this->winnerUser = 0;
        } else {        
            $this->winnerUser = ($winCount >= 3) ? $this->currentUser : $this->enemyUser;
        }
                
        $this->date = self::$db->now();
        
        $data = Array(
            'idManager1' => $this->currentUser->getId(),
            'idManager2' => $this->enemyUser->getId(),
            'winner' => ($drawCount == $totalCount) ? 0 : $this->winnerUser->getId(),
            'date' => $this->date,
        );

        $id = self::$db->insert('matchHistory', $data);
        
        return ($id);
    }
        
    public function isWinner() {
        return ($this->winnerUser->getId() == $this->currentUser->getId()) ? TRUE : FALSE;
    }

    public function isDraw() {
        return ($this->winnerUser === 0);
    }

    public function getCurrentUser() {
        return ($this->currentUser);
    }
    
    public function getEnemyUser() {
        return ($this->enemyUser);
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
