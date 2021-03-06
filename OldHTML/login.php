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
    <form id="myForm" action="login()" class="login">
	<h1 class="title">Login</h1>
        <div>
            <input type="text" name="username" id="username" 
            placeholder="User Name"/>
        </div>
        <div>
            <input type="password" name="password" id="password"
            placeholder="Password"/>
        </div>
        <div class="userRole">
            <label><input type="radio" name="role" value="user" checked="checked">User</label>
            <label><input type="radio" name="role" value="manager">Manager</label>
			<label><input type="radio" name="role" value="admin">Admin</label>
        </div>
		<button id="submit" onclick="validate(); return false";/>Submit</button>
	</form>
    <p class="license">Business Tracker &copy; 2018</p>
    </div>
    </script>
</body>
</html>
