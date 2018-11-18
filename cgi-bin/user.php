<?php
class User {
    private $db;
    private $username;             // Emp_Username
    private $userrole = 0;         // Emp_Authority
    private $userloggedin = false;
    
    function __construct($db) 
    {
        session_start();            // Start new or resume existing session
        $session_id = session_id(); // Get and/or set the current session id

        $this->db = $db;
    }

    /****************************************/

    function login()
    {
        if( isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

            $db = new Db();
            $name = $db -> quote($_POST['username']);
            // $pass = $db -> quote($_POST['password']);

            $user = $db -> query("SELECT Emp_Name FROM Employee WHERE Emp_Name = ". $name . ";");
            $hash = $db -> query("SELECT Emp_Password FROM Employee WHERE Emp_Name = ". $name . ";");
            if(password_verify($pass, $hash)) {
                return false;
            }

            if($_POST['username'] == $user && $_POST['password'] == $pass) {
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = 'tutorialspoint';
            }


            if($hash) {
            } else {

            }

            // Check Database
            // User Logged in
            // User not Logged in
        }
    }
    function logout()
    {
        // Log user out
        session_start();
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);

        header('Refresh: 2; URL = login.html');
    }
    function register()
    {
        $db = new Db();    
        $name = $db -> quote($_POST['username']);
        
        // Create new User
        $result = $db -> query("INSERT INTO `users` (`name`,`email`) VALUES (" . $name . "," . $email . ")");
    }
    function setPassword()
    {
        // Create User password
    }

    /****************************************/

    function getUserName() { return $this->username; }
    function getFirstName() { return $this->firstname; }
    function getLastName() { return $this->lastname; }
    function getUserStatus() { return $this->userloggedin; }
    function getUserRole() { return $this->userrole; }
}
?>
