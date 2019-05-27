<?php

include(__DIR__ . '/../inc.config.php');
include(CWD.'/includes/inc.player.php');

class Card {
    private $id;
    private $userObject;
    private $playerObject;
    private $dateCreation;
    private $position;
    
    public static $db;
        
    public function __construct($id) {
        $this->id = $id;
        
        $this->load();
    }
    
    public function load() {
        self::$db->where('idCard', $this->id);
        $r = self::$db->getOne('cardplayer');
        if(!$r || !isset($r)) {
            return FALSE;
        }
        
        $this->userObject = User::getUserById($r['idManager']);
        $this->playerObject = new Player($r['idPlayer']);
        $this->dateCreation = $r['dateCreation'];
        $this->position = $r['position'];
    }
    
    public function getUser() {
        return $this->userObject;
    }
    
    public function getPlayer() {
        return $this->playerObject;
    }
    
    public static function getAllCards() {
        $cards = self::$db->get('cardplayer', null, 'idCard');
        if($cards && self::$db->count > 0) {
            $cardList = Array();
            foreach($cards as $card) {
                $c = new Card($card['idCard']);
                array_push($cardList, $c);
            }
            
            return $cardList;
        }
        
        return FALSE;
    } 
}

if (!isset(Card::$db)) {
    Card::$db = MysqliDb::getInstance(); // this is a little hack to initialize a static variable
}

?>
