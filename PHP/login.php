<?php
require_once("db.php");

// Create User Session
session_start();

// If User is Logged in already, redirect to home
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	if($_SESSION["userrole"] == 1)
        header("Location: userHome.php");
    else if($_SESSION["userrole"] == 2 && $_SESSION["userrole"] == 3)
        header("Location: managerHome.php");
    exit;
}

$username = $password = ""; // Initialize User and Pass
$usererror = "";            // Username Error
$passerror = "";            // Password Error

// Handle POST request
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if the POST has values
    if(!empty(trim($_POST["username"]))) { // Given Username
        $username = trim($_POST["username"]);
    } else {                               // No Username Given
        $usererror = "Username field cannot be empty.";
        exit;
    }

    if(!empty(trim($_POST["password"]))) { // Given password
        $password = trim($_POST["password"]);
    } else {                               // No password Given
        $passerror = "Password field cannot be empty.";
        exit;
    }

    // Connect to Database
    $db = new Db();    

    $name = $db -> quote($_POST['username']);
    $pass = $db -> quote($_POST['password']);

    // Select User Values
    $query = $db -> select("SELECT `Emp_Name`, `Emp_Password`, `Emp_Authority` FROM `Employee` WHERE `Emp_Name` = " . $name . ";");

    // Assign Associative Array Values to Variables
    $user = $query[0]['Emp_Name'];
    $hash = $query[0]['Emp_Password'];
    $role = $query[0]['Emp_Authority'];

    // Create new User session
    if ($user == $username && $hash == $password) { // Compare Database with POST
        session_start();

        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $username; 
        $_SESSION["userrole"] = $role; 
	
	if($_SESSION["userrole"] == 1)
        	header("Location: userHome.php");
    else if($_SESSION["userrole"] == 2 && $_SESSION["userrole"] == 3)
        	header("Location: managerHome.php");
    } else { // Error with User input
        $usererror = "Username or password does not match. Please try again.";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="utf-8" />
	<script src="../Scripts/script.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css">	
</head>
<body>
    <div class="content">
	<img src="../Images/logo2.png" alt = "logo" id = "logo" class="topleft"> 
    <form id="myForm" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="login" method="post">
        <h1 class="title">Login</h1>
        <div <?php echo (!empty($usererror)) ? 'has-error' : ''; ?> >
            <input type="text" name="username" id="username" 
            placeholder="User Name"/>
        </div>
        <div <?php echo (!empty($passerror)) ? 'has-error' : ''; ?> >
            <input type="password" name="password" id="password"
            placeholder="Password"/>
        </div>
        <!--
        <div class="userRole">
            <label><input type="radio" name="role" value="user" checked="checked">User</label>
            <label><input type="radio" name="role" value="manager">Manager</label>
			<label><input type="radio" name="role" value="admin">Admin</label>
        </div>
        -->
		<button id="submit" onsubmit="return false;">Submit</button>
	</form>
    <p class="license">Business Tracker &copy; 2018</p>
    </div>
</body>
</html>
