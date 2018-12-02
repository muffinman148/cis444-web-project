function validate()
{
	var username = document.getElementById("username").value;
	var pass = document.getElementById("password").value;
	//Check username and password. Assume values a a are a valid user.
	// if((username=="a")&&(pass=="a"))
	//     location.href="managerHome.html";
	// else
	//     alert("Invalid username or password");

    if(username=="") { alert("Username field is empty. Please input a valid username."); }
    if(pass=="") { alert("Password field is empty. Please input a valid password."); }
}
