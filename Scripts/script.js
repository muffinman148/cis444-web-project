function validate()
{
	var username = document.getElementById("username").value;
	var pass = document.getElementById("password").value;
	//Check username and password. Assume values a a are a valid user.
	if((username=="a")&&(pass=="a"))
		location.href="clientHome.html";
	else
		alert("Invalid username or password");
}
