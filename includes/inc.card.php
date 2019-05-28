<?php

include(__DIR__ . '/../inc.config.php');
include(CWD.'/includes/inc.player.php');

class Card {
    private $id;
    private $userObject;
    private $playerObject;
    private $dateCreation;
    private $position;
    private $inMarket;
    private $isAligned;
    private $contractDaysLeft;
    
    public static $db;
        
    public function __construct($id) {
        $this->id = $id;
        
        $this->load();
    }
    
    public static function createCard($user, $player) {
        $data = Array(
            'idPlayer' => $player->getId(),
            'idManager' => $user->getId(),
            'dateCreation' => self::$db->now(),
            'inMarket' => '0',
            'aligned' => '1',
            'contractDaysLeft' => '50',
            'position' => ''
        );

        $id = self::$db->insert('cardplayer', $data);
        if(!$id) {
            return FALSE;
        }
        
        $card = new Card($id);
        return $card;
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
        $this->inMarket = $r['inMarket'];
        $this->isAligned = $r['aligned'];
        $this->contractDaysLeft = $r['contractDaysLeft'];        
    }
    
    public function getUser() {
        return $this->userObject;
    }
    
    public function getPlayer() {
        return $this->playerObject;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getPosition() {
        return $this->position;
    }
    
    public function setPosition($newPosition) {
        $data = Array(
            'position' => $newPosition,
        );
        
        self::$db->where('idCard', $this->id);
        $r = self::$db->update('cardplayer', $data);
        
        $this->load();
        
        return ($r);
    }
    
    public function setAligned($newAlignment) {
        $data = Array(
            'aligned' => $newAlignment,
        );
        
        self::$db->where('idCard', $this->id);
        $r = self::$db->update('cardplayer', $data);
        
        $this->load();
        
        return ($r);
    }
    
    public function isSample() {
        $accountId = strtolower($this->getPlayer()->getAccountId());
        $summonerId = strtolower($this->getPlayer()->getSummonerId());
                
        return ($accountId == 'sample' && $summonerId == 'sample');
    }
    
    public function isInMarket() {
        return $this->inMarket;
    }
    
    public function isAligned() {
        return $this->isAligned;
    }
    
    public function getContractDaysLeft() {
        return $this->contractDaysLeft;
    }
    
    public function transfer($newUserId) {
        $data = Array(
            'idManager'  => $newUserId
        );
        
        self::$db->where('idCard', $this->id);
        $r = self::$db->update('cardplayer', $data);
        
        $this->load();
        
        return ($r);
    }
    
    public function addToMarket() {
        $data = Array(
            'inMarket'  => '1'
        );
        
        self::$db->where('idCard', $this->id);
        $r = self::$db->update('cardplayer', $data);
        
        $this->load();
        
        return ($r);
    }
    
    public function removeFromMarket() {
        $data = Array(
            'inMarket'  => '0'
        );
        
        self::$db->where('idCard', $this->id);
        $r = self::$db->update('cardplayer', $data);
        
        $this->load();
        
        return ($r);
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
