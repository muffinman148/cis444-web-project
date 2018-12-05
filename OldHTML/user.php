<?php
require_once('db.php');

class User {
    private $db;
    private $username;             // Emp_Username
    private $password;             // Emp_Password
    private $userrole = 0;         // Emp_Authority
    private $userloggedin = false;
    
    function __construct($username, $password) 
    {
        session_start();            // Start new or resume existing session
        $session_id = session_id(); // Get and/or set the current session id

        $this->username = $username;
        $this->password = $password;

        $db = new Db();
    }

    /****************************************/

    public static function login()
    {
        echo "Login function running";
        // Check Form
        if( !empty($_POST['username']) && !empty($_POST['password'])) {
            echo "Form is Posted";

            // Connect to Database
            $db = new Db();
            $name = $db -> quote($_POST['username']);
            $pass = $db -> quote($_POST['password']);
            echo "Database is connected to";

            // Grab info from Database
            $user = $db -> query("SELECT Emp_Name      FROM Employee WHERE Emp_Name = ". $name . ";");
            $hash = $db -> query("SELECT Emp_Password  FROM Employee WHERE Emp_Name = ". $name . ";");
            $role = $db -> query("SELECT Emp_Authority FROM Employee WHERE Emp_Name = ". $name . ";");

            // Verify User
            if($_POST['username'] == $user && $_POST['password'] == $pass) {
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $user;
                $_SESSION['role'] = $role;
            }

            // Redirect to Homepage
            header("Location: PHP/userHome.php");

            // Check Database
            // User Logged in
            // User not Logged in
        } else {
            echo "Login error. Try restarting the application or contacting a server administrator.";
            header("Refresh:0;");
        }
    }
    public static function logout()
    {
        // Log user out
        session_start();
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
        unset($_SESSION["timeout"]);
        unset($_SESSION["valid"]);
        unset($_SESSION["role"]);

        header('Refresh: 2; URL = login.html');
    }
    public static function register()
    {
        $db = new Db();    

        $name = $db -> quote($_POST['username']);
        $name = $db -> quote($_POST['password']);
        
        // Create new User
        $result = $db -> query("INSERT INTO `users` (`name`,`email`) VALUES (" . $name . "," . $email . ")");
    }
    public static function setPassword()
    {
        // Create User password
    }

    /****************************************/

    public static function getUserName() { return $this->username; }
    public static function getFirstName() { return $this->firstname; }
    public static function getLastName() { return $this->lastname; }
    public static function getUserStatus() { return $this->userloggedin; }
    public static function getUserRole() { return $this->userrole; }
}
?>
