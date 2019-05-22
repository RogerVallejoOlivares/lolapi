<?php

require('inc.config.php');

class User {
    private static $tableName = 'Manager';
    private static $usernameField = 'email';
    private static $sessionKey = 'name';
    
    private $db;
    
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
        $this->db = MysqliDb::getInstance();
        
        $this->load();
        
        return $this;
    }
    
    /** Static functions **/
    public static function exists($name) {
        $db = MysqliDb::getInstance();
        $db->where(self::$usernameField, $name);
        $count = $db->getValue(self::$tableName, 'count(*)');
        if ($count !== null && is_int($count)) {
            return ($count > 0);
        }

        return false;
    }
        
    public static function register($name, $lastName, $email, $password, $phone, $birthDay) {
        if( !isset($name) || 
            !isset($lastName) || 
            !isset($email) || 
            !isset($password) || 
            !isset($phone) ||
            !isset($birthDay)
        ) {
            return false;
        }
        
        if(User::exists($name)) {
            return false;
        }
        
        $data = Array(
            'name'      => $name,
            'lastname'  => $lastName,
            'email'     => $email,
            'password'  => $password,
            'phone'     => $phone,
            'birthDay'  => $birthDay
        );
                       
        $db = MysqliDb::getInstance();
        $db->insert(self::$tableName, $data);
        
        if(!User::exists($data[self::$usernameField])) {
            return false;
        }
        
        $user = new User($data[self::$usernameField]);
        return $user;
    }
    
    public static function getCurrentUser() {
        if(!isset($_SESSION)) {
            return false;
        }
        
        if(!isset($_SESSION[self::$sessionKey])) {
            return false;
        }
        
        $user = new User($_SESSION[self::$sessionKey]);
        return ($user);
    }
    
    /** Class functions **/
    public function load() {
        $this->db->where(self::$usernameField, $this->userPropierties[self::$usernameField]);
        $r = $this->db->getOne(self::$tableName);

        if(isset($r) && $this->db->count > 0) {        
            $this->userPropierties['id'] = $r['idManager'];
            $this->userPropierties['lastname'] = $r['lastname'];
            $this->userPropierties['email'] = $r['email'];
            $this->userPropierties['password'] = $r['password'];
            $this->userPropierties['phone'] = $r['phone'];
            $this->userPropierties['phone'] = $r['phone'];
            $this->userPropierties['phone'] = $r['phone'];
            $this->userPropierties['elo'] = $r['elo'];
        }
        
        return ($this->userPropierties);;
    }
    
    public function save() {
        $this->db->where(self::$usernameField, $this->userPropierties[self::$usernameField]);
        $r = $this->db->update(self::$tableName, $this->userPropierties);
        return ($r);
    }
    
    public function delete() {
        $this->db->where(self::$usernameField, $this->userPropierties[self::$usernameField]);
        $r = $this->db->delete(self::$tableName);
        return ($r);
    }
    
    public function hashPassword($password) {
        $hashedPassword = base64_encode($password); // this MUST be better (SHA-512?)
        return ($hashedPassword);
    }
    
    public function login($password) {
        if(!User::exists($this->userPropierties[self::$usernameField])) {
            return false;
        }
        
        if(!isset($_SESSION)) {
            @session_start();
        }
        
        if(!isset($_SESSION)) {
            // session cannot be created
            return false;
        }
        
        if($this->hashPassword($password) != $this->getPassword()) {
            return false;
        }
        
        $_SESSION[self::$sessionKey] = $this->userPropierties[self::$usernameField];
        
        return true;
    }
    
    public function logout() {
        if($this->isLogged() && $_SESSION[self::$sessionKey] == $this->userPropierties[self::$usernameField]) {
            $_SESSION[self::$sessionKey] = ''; // seems that the use of 'unset($_SESSION[...]' is not a good practice, so we empty manually the session variable
            @session_destroy();
            return true;
        }
        
        return false;
    }
    
    public function isLogged() {
        if(isset($_SESSION)) {
            if(isset($_SESSION[self::$sessionKey])) {
                return ($_SESSION[self::$sessionKey] == $this->userPropierties[self::$usernameField]);
            }
        }
        
        return false;
    }

    /* Getters & setters */

    public function getName($reload = false) {
        return ($this->userName);
    }

    public function setName($name) {
        $this->userName = $name;
    }   
    
    private function getProperty($key, $reload = false) {
        if(!isset($this->userName)) {
            $reload = true;
        }
        
        if(!$reload) {
            return ($this->userPropierties[$key]);
        }
        
        $this->load();
        $this->getProperty($key, false);
    }
    
    public function getPassword($reload = false) {
        $property = $this->getProperty('password', $reload);
        //$property = $this->hashPassword($property);
        return ($property);
    }
    
    public function setPassword($property) {
        $this->userPropierties['password'] = $this->hashPassword($property);
    }
    
    public function getLastName($reload = false) {
        $property = $this->getProperty('lastname', $reload);
        return ($property);
    }
    
    public function setLastName($property) {
        $this->userPropierties['lastname'] = $property;
    }
    
     public function getEmail($reload = false) {
        $property = $this->getProperty('email', $reload);
        return ($property);
    }
    
    public function setEmail($property) {
        $this->userPropierties['email'] = $property;
    }
    
     public function getPhone($reload = false) {
        $property = $this->getProperty('phone', $reload);
        return ($property);
    }
    
    public function setPhone($property) {
        $this->userPropierties['phone'] = $property;
    }
    
     public function getBirthday($reload = false) {
        $property = $this->getProperty('birthDay', $reload);
        return ($property);
    }
    
    public function setBirthday($property) {
        $this->userPropierties['birthDay'] = $property;
    }
    
     public function getGold($reload = false) {
        $property = $this->getProperty('gold', $reload);
        return ($property);
    }
    
    public function setGold($property) {
        $this->userPropierties['gold'] = $property;
    }
    
     public function getElo($reload = false) {
        $property = $this->getProperty('elo', $reload);
        return ($property);
    }
    
    public function setElo($property) {
        $this->userPropierties['elo'] = $property;
    }
}
?>
