<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<?php 
		//ini_set('display_errors', 'On');
		//error_reporting(E_ALL | E_STRICT);

		//Credentials and database details
		$servername = "localhost";
		$username = "group3";
		$password = "38IkUwFEhxfq";
		$dbname = "group3";

		//$id =  $_GET['orderBy'];

		if (isset($_POST["editUser"])) {
			print "Edit user button was pressed <br>";
			getRecord("Employee",$_POST['orderBy']);

		}
		elseif (isset($_POST["createUser"])) {
			print "Create user buton was pressed <br>";
			createRecord("Employee");
		}
		elseif (isset($_POST["deleteUser"])) {
			print "Delete user Button was pressed";
			deleteUser();
		}
		elseif (isset($_POST["editProduct"])) {
			print "Edit product Button was pressed";
			getRecord("Product",$_POST['orderBy']);
		}
		elseif (isset($_POST["createProduct"])) {
			print "Create product Button was pressed";
			createRecord("Product");
		}
		elseif (isset($_POST["deleteProduct"])) {
			print "Delete Product Button was pressed";
			deleteProduct();
		}
		else {
			print "Something is wrong";
		}

		function getRecord($table,$id){
			// Create Connection
			$conn = mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);

			// Check connection
			if (!$conn) {
				die("Connect failed: " . mysqli_connect_error());
			}

			if ($table == "Employee") {
				$tablePK = "Emp_Id";
			}
			elseif ($table == "Product") {
				$tablePK = "Prod_id";
			}

			//Execute query
			$sql = "SELECT * FROM ".$table." WHERE ".$tablePK." = ".$id.";" ;
			$result = mysqli_query($conn, $sql);

			$num_fields = mysqli_num_fields($result);
			$row = mysqli_fetch_assoc($result);
			$keys = array_keys($row);
			$values = array_values($row);

			print "<form action=\"confirmAdmin.php\" method=\"post\">";

			for ($index=0; $index < $num_fields; $index++) {
				$value = htmlspecialchars($values[$index]); 
				print $keys[$index].": <input type=\"text\" name=".$keys[$index]." value=\"".$value."\"> <br>";
				var_dump($value);

			}
			if ($table == "Employee") {
				print "<input type=\"submit\" name=\"editUser\">";	
			}
			elseif ($table == "Product") {
				print "<input type=\"submit\" name=\"editProduct\">";	
			}
			print "</form>";
		}

		function createRecord($table) {
			// Create Connection
			$conn = mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);

			// Check connection
			if (!$conn) {
				die("Connect failed: " . mysqli_connect_error());
			}

			//Execute query
			$sql = "SELECT * FROM ".$table.";" ;
			$result = mysqli_query($conn, $sql);

			$num_fields = mysqli_num_fields($result);
			$row = mysqli_fetch_assoc($result);
			$keys = array_keys($row);

			print "<form action=\"confirmAdmin.php\" method=\"post\">";

			for ($index=0; $index < $num_fields; $index++) {
				print $keys[$index].": <input type=\"text\" name=".$keys[$index]."><br>";

			}
			if ($table == "Employee") {
				print "<input type=\"submit\" name=\"createUser\">";	
			}
			elseif ($table == "Product") {
				print "<input type=\"submit\" name=\"createProduct\">";	
			}
			print "</form>";
		}

		function deleteUser() {
		// Create connection
		$conn = mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "DELETE from Employee WHERE Emp_Id=".$_POST['orderBy'].";";

		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}

		$conn->close();

		print "SQL updated <br><a href=\"admin.php\">Go Back</a>";
	}

		function deleteProduct() {
			// Create connection
			$conn = mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			$sql = "DELETE from Product WHERE Prod_id=".$_POST['orderBy'].";";

			if ($conn->query($sql) === TRUE) {
			    echo "Record updated successfully";
			} else {
			    echo "Error updating record: " . $conn->error;
			}

			$conn->close();

			print "SQL updated <br><a href=\"admin.php\">Go Back</a>";
		}	
	 ?>
</body>
</html>