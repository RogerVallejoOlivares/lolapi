<?php

require(__DIR__.'/../inc.config.php');

class Match {
    private $current_user;
    private $enemy_user;
    
    private static $db;
    
    public function __construct($current_user, $enemy_user) {
        $this->current_user = $current_user;
        $this->enemy_user = $enemy_user;
        
        self::$db = MysqliDb::getInstance();
    }
    
    public static function getUserWithNearestElo($current_elo, $from_id) {
        // SELECT * FROM manager WHERE idManager != 1 ORDER BY abs(elo - $current_elo) LIMIT 1
        $db = MysqliDb::getInstance();
        
        $db->orderBy('abs(elo - '.$current_elo.')', 'ASC');
        $db->where('idManager', $from_id, '!=');
        $result = $db->getOne('manager');
     
        if($result !== FALSE) {
            $enemy_user_name = $result['email'];
            if(User::exists($enemy_user_name)) {
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


    public function getCurrentUser() {
        return ($this->current_user);
    }
    
    public function getEnemyUser() {
        return ($this->enemy_user);
    }
    
}

?>
