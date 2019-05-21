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
    
    print("[+] empty user exists? ".(User::userExists('') ? "YES" : "NO").PHP_EOL);
    
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
    print("[+] new user exists? ".(User::userExists($newUserData['name']) ? "YES" : "NO").PHP_EOL);
    print("[+] deleted new user? ".($newUser->delete() ? "YES" : "NO").PHP_EOL);
    print("[+] new user exists after delete? ".(User::userExists($newUserData['name']) ? "YES" : "NO").PHP_EOL);    
        
?>