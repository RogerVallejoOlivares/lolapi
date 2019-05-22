<?php
    error_reporting( E_ALL );
    (PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) && die('cli only');
    
    assert_options(ASSERT_ACTIVE, 1);
    assert_options(ASSERT_WARNING, 0);
    assert_options(ASSERT_QUIET_EVAL, 1);
    
    require("inc.user.php");
    
    $db = MysqliDb::getInstance();
    //print("ping to db = ".($db->ping()).PHP_EOL);
    
    print("[#] test user class".PHP_EOL);
    
    print("[#] user creation tests".PHP_EOL);
    
    print("[+] empty user exists? ".(User::exists('') ? "YES" : "NO").PHP_EOL);
    
    //$name, $lastname, $email, $password, $phone, $birthDay
    $newUserData = Array(
        'name' => 'Erik',
        'lastname' => 'Asís',
        'email' => 'erik@test.com',
        'password' => 'hunter2',
        'phone' => '600708090',
        'birthDay' => strtotime("1993-07-21")
    );
    
    $newUser = User::register(
            $newUserData['name'], 
            $newUserData['lastname'],
            $newUserData['email'],
            $newUserData['password'],
            $newUserData['phone'],
            $newUserData['birthDay']
    );
    
    print("[+] user registered? ".($newUser ? "YES" : "NO").PHP_EOL);
    print("[+] new user exists? ".(User::exists($newUserData['name']) ? "YES" : "NO").PHP_EOL);
    print("[+] deleted new user? ".($newUser != false && $newUser->delete() ? "YES" : "NO").PHP_EOL);
    print("[+] new user exists after delete? ".(User::exists($newUserData['name']) ? "YES" : "NO").PHP_EOL);    
    
    print("[#] user session test".PHP_EOL);
    
    $newUser = null;         
    $newUser = User::register(
        $newUserData['name'], 
        $newUserData['lastname'],
        $newUserData['email'],
        $newUserData['password'],
        $newUserData['phone'],
        $newUserData['birthDay']
    );
     
    print("[+] new user is logged before login? ".($newUser != false && $newUser->isLogged() ? "YES" : "NO").PHP_EOL);
    print("[+] new user login? ".(isset($newUser) && $newUser->login() ? "YES" : "NO").PHP_EOL);
    print("[+] new user is logged after login? ".($newUser != false && $newUser->isLogged() ? "YES" : "NO").PHP_EOL);
    print("[+] new user logout? ".(isset($newUser) && $newUser->logout() ? "YES" : "NO").PHP_EOL);
    print("[+] new user is logged after logout? ".($newUser != false && $newUser->isLogged() ? "YES" : "NO").PHP_EOL);
    print("[+] new user deleted? ".($newUser != false && $newUser->delete() ? "YES" : "NO").PHP_EOL);
     
?>