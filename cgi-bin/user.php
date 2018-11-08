<?php
class User {
    private $db;
    private $username;
    private $firstname;
    private $lastname;
    private $userrole = 0;
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
        // Check Database
        // User Logged in
        // User not Logged in
    }
    function logout()
    {
        // Log user out
    }
    function register()
    {
        // Create new User
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
