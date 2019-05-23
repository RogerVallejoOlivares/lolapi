<?php

require(__DIR__.'/../inc.config.php');

class User {

    private static $tableName = 'Manager'; // database table where users are stored
    private static $usernameField = 'email'; // database column with login username
    private static $sessionKey = 'name'; // key used in session variable to know if a user is logged in
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

    /** Static functions * */
    public static function exists($name) {
        $db = MysqliDb::getInstance();
        $db->where(self::$usernameField, $name);
        $count = $db->getValue(self::$tableName, 'count(*)');
        if ($count !== null && is_int($count)) {
            return ($count > 0);
        }

        return FALSE;
    }

    public static function register($name, $lastName, $email, $password, $phone, $birthDay) {
        if (!isset($name) ||
                !isset($lastName) ||
                !isset($email) ||
                !isset($password) ||
                !isset($phone) ||
                !isset($birthDay)
        ) {
            return FALSE;
        }

        if (User::exists($name)) {
            return FALSE;
        }

        $data = Array(
            'name' => $name,
            'lastname' => $lastName,
            'email' => $email,
            'password' => self::hashPassword($password),
            'phone' => $phone,
            'birthDay' => $birthDay
        );

        $db = MysqliDb::getInstance();
        $db->insert(self::$tableName, $data);

        if (User::exists($data[self::$usernameField]) === FALSE) {
            return FALSE;
        }

        $user = new User($data[self::$usernameField]);
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

    /** Class functions * */
    public function load() {
        $this->db->where(self::$usernameField, $this->userPropierties[self::$usernameField]);
        $r = $this->db->getOne(self::$tableName);

        if (isset($r) && $this->db->count > 0) {
            $this->userPropierties['id'] = $r['idManager'];
            $this->userPropierties['name'] = $r['name'];
            $this->userPropierties['lastname'] = $r['lastname'];
            $this->userPropierties['email'] = $r['email'];
            $this->userPropierties['password'] = $r['password'];
            $this->userPropierties['phone'] = $r['phone'];
            $this->userPropierties['birthDay'] = $r['birthDay'];
            $this->userPropierties['gold'] = $r['gold'];
            $this->userPropierties['elo'] = $r['elo'];
        }

        return ($this->userPropierties);
    }

    public function save() {
        $data = $this->userPropierties;
        unset($data['id']); // do not modify the id ;)
        
        $this->db->where(self::$usernameField, $data[self::$usernameField]);
        $r = $this->db->update(self::$tableName, $data);

        if($r) {
            $this->load();
        }
        
        return ($r);
    }

    public function delete() {
        $this->db->where(self::$usernameField, $this->userPropierties[self::$usernameField]);
        $r = $this->db->delete(self::$tableName);
        return ($r);
    }

    public static function hashPassword($password) {
        $hashedPassword = base64_encode($password); // this MUST be better (SHA-512?)
        return ($hashedPassword);
    }

    public function login($password) {
        if (User::exists($this->userPropierties[self::$usernameField]) === FALSE) {
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

    public function getPassword($reload = FALSE) {
        $property = $this->getProperty('password', $reload);
        //$property = self::hashPassword($property);
        return ($property);
    }

    public function setPassword($property) {
        $this->userPropierties['password'] = self::hashPassword($property);
    }
    
    public function getName($reload = FALSE) {
        $property = $this->getProperty('name', $reload);
        return ($property);
    }

    public function setName($property) {
        $this->userPropierties['name'] = $property;
    }

    public function getLastName($reload = FALSE) {
        $property = $this->getProperty('lastname', $reload);
        return ($property);
    }

    public function setLastName($property) {
        $this->userPropierties['lastname'] = $property;
    }

    public function getEmail($reload = FALSE) {
        $property = $this->getProperty('email', $reload);
        return ($property);
    }

    public function setEmail($property) {
        $this->userPropierties['email'] = $property;
    }

    public function getPhone($reload = FALSE) {
        $property = $this->getProperty('phone', $reload);
        return ($property);
    }

    public function setPhone($property) {
        $this->userPropierties['phone'] = $property;
    }

    public function getBirthday($reload = FALSE) {
        $property = $this->getProperty('birthDay', $reload);
        return ($property);
    }

    public function setBirthday($property) {
        $this->userPropierties['birthDay'] = $property;
    }

    public function getGold($reload = FALSE) {
        $property = $this->getProperty('gold', $reload);
        return ($property);
    }

    public function setGold($property) {
        $this->userPropierties['gold'] = $property;
    }

    public function getElo($reload = FALSE) {
        $property = $this->getProperty('elo', $reload);
        return ($property);
    }

    public function setElo($property) {
        $this->userPropierties['elo'] = $property;
    }

}
?>

