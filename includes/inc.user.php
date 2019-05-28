<?php

include(__DIR__ . '/../inc.config.php');

class User {

    private static $tableName = 'Manager'; // database table where users are stored
    private static $usernameField = 'email'; // database column with login username
    private static $sessionKey = 'name'; // key used in session variable to know if a user is logged in
    public static $db;
    private $exists;
    private $userPropierties = Array(
        'id' => '',
        'name' => '',
        'lastname' => '',
        'email' => '',
        'password' => '',
        'phone' => '',
        'birthDay' => '',
        'gold' => 0,
        'elo' => 0
    );

    function __construct($name) {
        $this->userPropierties[self::$usernameField] = $name;

        $this->exists = false;
        if($this->load() !== FALSE) {
            $this->exists = true;
        }

        return $this;
    }

    /** Static functions * */
    public static function userExists($name) {
        self::$db->where(self::$usernameField, $name);
        $count = self::$db->getValue(self::$tableName, 'count(*)');
        if ($count !== null && is_int($count)) {
            return ($count > 0);
        }

        return FALSE;
    }

    public static function register($name, $lastName, $email, $password, $phone, $birthDay) {
        if (!isset($name) ||
                !isset($lastName) ||
                !isset($email) ||
                !isset($password)
        ) {
            return FALSE;
        }

        if (User::userExists($email)) {
            return FALSE;
        }

        $data = Array(
            'name' => $name,
            'lastname' => $lastName,
            'email' => $email,
            'password' => self::hashPassword($password),
            'phone' => isset($phone) ? $phone : '',
            'birthDay' => isset($birthDay) ? $birthDay : '',
        );

        self::$db->insert(self::$tableName, $data);

        if (User::userExists($data[self::$usernameField]) === FALSE) {
            return FALSE;
        }

        $user = new User($data[self::$usernameField]);
        
        // add sample cards
        $samplePlayers = Array('Top', 'Jungle', 'Mid', 'Adc', 'Support');
        foreach($samplePlayers as $sample) {
            $player = Player::getPlayerByName($sample.' Sample');
            $card = Card::createCard($user, $player);
            $card->setPosition(strtolower($sample));
        }
        
        return $user;
    }

    public static function getCurrentUser() {
        if (!isset($_SESSION)) {
            return FALSE;
        }

        if (!isset($_SESSION[self::$sessionKey])) {
            return FALSE;
        }

        $user = new User($_SESSION[self::$sessionKey]);
        return ($user);
    }
    
    public static function getAllUsers() {
        $users = self::$db->get(self::$tableName, null, self::$usernameField);
        if($users && self::$db->count > 0) {
            $userList = Array();
            foreach($users as $user) {
                $u = new User($user[self::$usernameField]);
                array_push($userList, $u);
            }
            
            return $userList;
        }
        
        return FALSE;
    }

    public static function getUserById($id) {
        if (!isset($id)) {
            return FALSE;
        }

        $userId = (int) $id; // this is to prevent sql injection
        if ($userId <= 0) {
            return FALSE;
        }

        self::$db->where('idManager', $userId);
        $r = self::$db->getOne(self::$tableName);
        if (isset($r) && self::$db->count > 0) {
            $userName = $r[self::$usernameField];
            if (!isset($userName) || empty($userName)) {
                return FALSE;
            }

            $user = new User($userName);
            return $user;
        }

        return FALSE;
    }

    public static function compare($user1, $user2) {
        return ($user1->getId() == $user2->getId());
    }
    
    /** Class functions * */
    public function exists() {
        return $this->exists;
    }
    
    public function load() {
        self::$db->where(self::$usernameField, $this->userPropierties[self::$usernameField]);
        $r = self::$db->getOne(self::$tableName);

        if (isset($r) && self::$db->count > 0) {
            $this->userPropierties['id'] = $r['idManager'];
            $this->userPropierties['name'] = $r['name'];
            $this->userPropierties['lastname'] = $r['lastname'];
            $this->userPropierties['email'] = $r['email'];
            $this->userPropierties['password'] = $r['password'];
            $this->userPropierties['phone'] = $r['phone'];
            $this->userPropierties['birthDay'] = $r['birthDay'];
            $this->userPropierties['gold'] = $r['gold'];
            $this->userPropierties['elo'] = $r['elo'];
        } else {
            return FALSE;
        }       

        return ($this->userPropierties);
    }

    public function save() {
        $data = $this->userPropierties;
        unset($data['id']); // do not modify the id ;)

        self::$db->where(self::$usernameField, $data[self::$usernameField]);
        $r = self::$db->update(self::$tableName, $data);

        if ($r) {
            $this->load();
        }

        return ($r);
    }

    public function delete() {
        self::$db->where(self::$usernameField, $this->userPropierties[self::$usernameField]);
        $r = self::$db->delete(self::$tableName);
        if($r) {
            $this->exists = false;
        }
        
        return ($r);
    }

    public static function hashPassword($password) {
        $hashedPassword = base64_encode($password); // this MUST be better (SHA-512?)
        return ($hashedPassword);
    }

    public function login($password) {
        if (User::userExists($this->userPropierties[self::$usernameField]) === FALSE) {
            return FALSE;
        }

        if (!isset($_SESSION)) {
            @session_start();
        }

        if (!isset($_SESSION)) {
            // session cannot be created
            return FALSE;
        }

        if (self::hashPassword($password) != $this->getPassword()) {
            return FALSE;
        }

        $_SESSION[self::$sessionKey] = $this->userPropierties[self::$usernameField];

        return ($this->isLogged());
    }

    public function logout() {
        echo '[user.logout] start' . PHP_EOL;
        if ($this->isLogged() && $_SESSION[self::$sessionKey] == $this->userPropierties[self::$usernameField]) {
            $_SESSION[self::$sessionKey] = ''; // seems that the use of 'unset($_SESSION[...]' is not a good practice, so we empty manually the session variable
            @session_destroy();
            return true;
        }

        return FALSE;
    }

    public function isLogged() {
        if (isset($_SESSION)) {
            if (isset($_SESSION[self::$sessionKey])) {
                return ($_SESSION[self::$sessionKey] == $this->userPropierties[self::$usernameField]);
            }
        }

        return FALSE;
    }

    public function getCards() {
        $cardList = Array();
        self::$db->where('idManager', $this->getId());
        $cards = self::$db->get('cardplayer', null, 'idCard');
        foreach ($cards as $card) {
            if(!isset($card['idCard'])) {
                continue;
            }
            
            $p = new Card($card['idCard']);
            array_push($cardList, $p);
        }
        
        return $cardList;
    }
    
    public function getCardsByPosition($position) {
        $cards = $this->getCards();
        $cardsByPosition = Array();
        
        foreach($cards as $card) {
            if(strtolower($card->getPosition()) === strtolower($position)) {
                array_push($cardsByPosition, $card);
            }
        }
        
        return $cardsByPosition;
    }
    
    public function getAlignedCardInPosition($position) {
        $cards = $this->getCardsByPosition(strtolower($position));
        foreach($cards as $card) {
            if($card->isAligned()) {
                return $card;
            }
        }
        
        return FALSE;
    }
    
    /* Getters & setters */

    private function getProperty($key, $reload = FALSE) {
        if (!isset($this->userPropierties[self::$usernameField])) {
            return FALSE;
        }

        if ($reload === FALSE) {
            return ($this->userPropierties[$key]);
        }

        $this->load();
        $this->getProperty($key, FALSE);
    }

    public function getId($reload = FALSE) {
        $property = $this->getProperty('id', $reload);
        return ($property);
    }

    public function setId($property) {
        $this->userPropierties['id'] = $property;
        $this->save();
    }

    public function getPassword($reload = FALSE) {
        $property = $this->getProperty('password', $reload);
        //$property = self::hashPassword($property);
        return ($property);
    }

    public function setPassword($property) {
        $this->userPropierties['password'] = self::hashPassword($property);
        $this->save();
    }

    public function getName($reload = FALSE) {
        $property = $this->getProperty('name', $reload);
        return ($property);
    }

    public function setName($property) {
        $this->userPropierties['name'] = $property;
        $this->save();
    }

    public function getLastName($reload = FALSE) {
        $property = $this->getProperty('lastname', $reload);
        return ($property);
    }

    public function setLastName($property) {
        $this->userPropierties['lastname'] = $property;
        $this->save();
    }

    public function getEmail($reload = FALSE) {
        $property = $this->getProperty('email', $reload);
        return ($property);
    }

    public function setEmail($property) {
        $this->userPropierties['email'] = $property;
        $this->save();
    }

    public function getPhone($reload = FALSE) {
        $property = $this->getProperty('phone', $reload);
        return ($property);
    }

    public function setPhone($property) {
        $this->userPropierties['phone'] = $property;
        $this->save();
    }

    public function getBirthday($reload = FALSE) {
        $property = $this->getProperty('birthDay', $reload);
        return ($property);
    }

    public function setBirthday($property) {
        $this->userPropierties['birthDay'] = $property;
        $this->save();
    }

    public function getGold($reload = FALSE) {
        $property = $this->getProperty('gold', $reload);
        return ($property);
    }

    public function setGold($property) {
        $this->userPropierties['gold'] = $property;
        $this->save();
    }

    public function getElo($reload = FALSE) {
        $property = $this->getProperty('elo', $reload);
        return ($property);
    }

    public function setElo($property) {
        $this->userPropierties['elo'] = $property;
        $this->save();
    }

}

if (!isset(User::$db)) {
    User::$db = MysqliDb::getInstance(); // this is a little hack to initialize a static variable
}

?>

