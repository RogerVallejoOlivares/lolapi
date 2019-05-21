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

    $email = 'test@domain.com';
    print("[*] email: {$email}".PHP_EOL);
        
    print("[+] empty user exists? ".(User::userExists('') ? "YES" : "NO").PHP_EOL);
    print("[+] known user exists? ".(User::userExists($email) ? "YES" : "NO").PHP_EOL);
        
?>