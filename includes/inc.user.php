<?php

require('../inc.config.php');

class User {
    private static  $tableName = 'Manager';
    private static $usernameField = 'name';
    
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
    
    private $db;

    function __construct($name) {
        $this->userPropierties['name'] = $name;
        $this->db = MysqliDb::getInstance();
        
        return $this;
    }
    
    /** Static functions **/
    public static function userExists($name) {
        $db = MysqliDb::getInstance();
        $db->where(self::$usernameField, $name);
        $count = $db->getOne(self::$tableName, 'count(*)');
        if ($count !== null && is_int($count)) {
            return ($count > 0);
        }

        return false;
    }
        
    public static function register($name, $lastname, $email, $password, $phone, $birthDay) {
        if( !isset($name) || 
            !isset($lastname) || 
            !isset($email) || 
            !isset($password) || 
            !isset($phone) ||
            !isset($birthDay)
        ) {
            return false;
        }
        
        if(User::userExists($name)) {
            return false;
        }
        
        $data = Array(
            'name'      => $name,
            'lastname'  => $lastname,
            'email'     => $email,
            'password'  => $password,
            'phone'     => $phone,
            'birthDay'  => $birthDay
        );
                       
        $this->db->insert($this->tableName, $data);
        
        $user = new User($data[$this->usernameField]);
        return $user;
    }
    
    /** Class functions **/
    public function load() {
        $this->db->where($this->usernameField, $this->userPropierties[self::$usernameField]);
        $r = $db->getOne($this->tableName);
        if($r->count > 0) {        
            $this->userPropierties['id'] = $r['id'];
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
        $r = $this->db->update($this->userPropierties);
        return ($r);
    }
    
    public function hashPassword($password) {
        $password = base64_encode($password); // this MUST be better (SHA-512?)
        return ($password);
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
        $property = $this->hashPassword($property);
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

