<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css">
	<script src="../Scripts/script.js" type="text/javascript"></script>
	<img src="../Images/logo2.png" alt="logo" id="logo" class="topleft">
	<nav class="navigation">
        <a href="admin.php">Home</a>
		<a href="Budget.html">View Budget</a>
		<a href="login.html">Sign Out</a>
		<a href="adminForm.php">Test Page</a>
	</nav>
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

	function mySqlInitQuery($table) {

	 	// Create Connection
		$conn = mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);

		// Check connection
		if (!$conn) {
			die("Connect failed: " . mysqli_connect_error());
		}

		//Execute query
		$sql = "SELECT * FROM ".$table.";" ;
		$result = mysqli_query($conn, $sql);

		if (!$result) {
			print "Error - the query could not be executed" . mysql_error();
			exit;
		}

		mysqli_close($conn);

		return $result;		
	}

	function CreateTable($result,$tableName) {
	 	//Display the results in a table
		print "<table class=\"form\" id=\"adminTable\"><caption> <h2> ".$tableName." </h2> </caption>";
		print "<tr align = 'center'>";	

		//Get the number of rows in the result
		$num_rows = mysqli_num_rows($result);


		//Put rows in HTML table
		if ($num_rows > 0) {
			
			$row = mysqli_fetch_assoc($result);
			$num_fields = mysqli_num_fields($result);
			
		//Produce column labels	
			$keys = array_keys($row);
			for ($index = 0; $index < $num_fields; $index++)
				print "<th>" . $keys[$index] . "</th>";

			print "</th>";

		//Insert Data	
			for ($row_num = 0; $row_num < $num_rows; $row_num++) {
				print "<tr>";
				$values  = array_values($row);
				for ($index = 0; $index < $num_fields; $index ++) {
					$value = htmlspecialchars($values[$index]);
					print "<td>" . $value . "</td>";
				}
				print "</tr>";
				
				$row = mysqli_fetch_assoc($result);
			}
		}

		else {
			print "There were no such rows in the table <br />";
		}

		print "</table>";
	}

	function deleteRecord(){

	}

	function createRecord(){

	}
	?>
	<div class="content">
		<div class="wrapper">
			<div class="adminTable" id="UserAdministration"> 
				<?php 
					CreateTable(mySqlInitQuery("Employee"), "User Administation");
				 ?>
			</div>
			<div class="searchForm">
				<form method="post" action="adminHandleRequest.php"> 
            	<input type="text" name="orderBy" class="searchbar" placeholder="Search..."></input>
            	<input type="button" class="searchButton" value="Search" onclick="showUser(this.value)">
            	<input type="submit" class="searchButton" value="Create" name="createUser">
            	<input type="submit" class="searchButton" value="Edit" name="editUser">
            	<input type="submit" class="searchButton" value="Delete" name="deleteUser">
            </form>
        	</div>
			<div class="adminTable" id="ProductAdministration"> 
				<?php 
					CreateTable(mySqlInitQuery("Product"), "Product Administation");
				 ?>
			</div>
			<div class="searchForm">
				<form method="post" action="adminHandleRequest.php"> 
            	<input type="text" name="orderBy" class="searchbar" placeholder="Search..."></input>
            	<input type="button" class="searchButton" value="Search" onclick="showUser(this.value)">
            	<input type="submit" class="searchButton" value="Create" name="createProduct">
            	<input type="submit" class="searchButton" value="Edit" name="editProduct">
            	<input type="submit" class="searchButton" value="Delete" name="deleteProduct">
            </form>
        	</div>
		</div>
	</div>
	<br/>
</body>
</html>