<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<?php 
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);

			
	//Credentials and database details
	$servername = "localhost";
	$username = "group3";
	$password = "38IkUwFEhxfq";
	$dbname = "group3";
	

	if (isset($_POST["editUser"])) {
		print "Edit user button was pressed <br>";
		editUser();

	}
	elseif (isset($_POST["createUser"])) {
		print "Create user buton was pressed <br>";
		createUser();
	}
	elseif (isset($_POST["editProduct"])) {
		print "Edit product Button was pressed";
		editProduct();
	}
	elseif (isset($_POST["createProduct"])) {
		print "Create product Button was pressed";
		createProduct();
	}
	else {
		print "Something is wrong";
	}

	function editUser() {
		// Create connection
		$conn = mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "UPDATE Employee SET 
			Emp_Name=\"".$_POST["Emp_Name"]."\",
			EMP_Department=\"".$_POST["EMP_Department"]."\", 
			Emp_Password=\"".$_POST["Emp_Password"]."\", 
			Emp_Authority=".$_POST["Emp_Authority"]." 
			WHERE Emp_Id=".$_POST["Emp_Id"].";";

		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}

		$conn->close();
			}

	function createUser() {
		// Create connection
		$conn = mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO Employee VALUES(".
			$_POST["Emp_Id"].",'".
			$_POST["Emp_Name"]."','".
			$_POST["EMP_Department"]."','". 
			$_POST["Emp_Password"]."',". 
			$_POST["Emp_Authority"].");";

		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}

		$conn->close();
			} 		
 
	function editProduct() {
		// Create connection
		$conn = mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "UPDATE Product SET 
			Prod_Description=\"".$_POST["Prod_Description"]."\",
			Prod_Name=\"".$_POST["Prod_Name"]."\", 
			Prod_Price=".$_POST["Prod_Price"]." 
			WHERE Prod_id=".$_POST["Prod_id"].";";

		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}

		$conn->close();
			}

	function createProduct() {
		// Create connection
		$conn = mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO Product VALUES(".
			$_POST["Prod_id"].",'".
			$_POST["Prod_Description"]."','".
			$_POST["Prod_Name"]."',". 
			$_POST["Prod_Price"].");";

		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}

		$conn->close();
			}
 ?>
<body>
	SQL updated <br>

	 <a href="admin.php">Go Back</a>
</body>
</html>