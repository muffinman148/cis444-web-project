<!DOCTYPE html>
<!--Home Page for admins -->
<html lang = "en">
<head>
<title>Admin</title>
<meta charset = "utf-8" />
<link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css">
    <img src="../Images/logo2.png" alt = "logo" id = "logo" class="topleft"> 
	<nav class="navigation">
        <a href="admin_new.php">Home</a> 
		<a href="Budget.html">View Budget</a>
		<a href="login.html">Sign Out</a>
	</nav>
</head>
<body>
	<div class="content">
        <div class="wrapper">

        <div class="searchForm">
            <input type="text" name="orderBy" class="searchbar" placeholder="Search..."></input><button class="searchButton" onclick="validate()"/>Search</button>
        </div>

        <div id="UserAdmin">

        <?php

			//Credentials and database details
			$servername = "localhost";
			$username = "group3";
			$password = "38IkUwFEhxfq";
			$dbname = "group3";
			
			// Create Connection
			$conn = mysqli_connect($servername,$username,$password,$dbname);

			// Check connection
			if (!$conn) {
				die("Connect failed: " . mysqli_connect_error());
			}

			//Execute query
			$sql = "SELECT * FROM Employee;" ;
			$result = mysqli_query($conn, $sql);

			if (!$result) {
						echo "Error - the query could not be executed" . mysql_error();
						exit;
					}		
			
			//Display the results in a table
			echo "<table class=\"form\" id=\"adminTable\"><caption> <h2> User Administration </h2> </caption>";
			echo "<tr align = 'center'>";	

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

				echo "<th colspan="."2".">Admin Actions</th>";

			//Insert Data	
				for ($row_num = 0; $row_num < $num_rows; $row_num++) {
					print "<tr>";
					$values  = array_values($row);
					for ($index = 0; $index < $num_fields; $index ++) {
						$value = htmlspecialchars($values[$index]);
						print "<td>" . $value . "</td>";
					}
					print "<td><button class="."editUser".">Edit</button></td>";
                	print "<td><button class="."deleteUser".">Delete</button></td>";
					print "</tr>";
					
					$row = mysqli_fetch_assoc($result);
				}
			}

			else {
				print "There were no such rows in the table <br />";
			}

			print "</table>";

		
			mysqli_close($conn);

		?>

		<button class="createUser">Create User</button>
		</div>
		<div id="Product Administration">

        <?php

			//Credentials and database details
			$servername = "localhost";
			$username = "group3";
			$password = "38IkUwFEhxfq";
			$dbname = "group3";
			
			// Create Connection
			$conn = mysqli_connect($servername,$username,$password,$dbname);

			// Check connection
			if (!$conn) {
				die("Connect failed: " . mysqli_connect_error());
			}

			//Execute query
			$sql = "SELECT * FROM Product;" ;
			$result = mysqli_query($conn, $sql);

			if (!$result) {
						echo "Error - the query could not be executed" . mysql_error();
						exit;
					}		
			
			//Display the results in a table
			echo "<table class=\"form\" id=\"adminTable\"><caption> <h2> Product Administration </h2> </caption>";
			echo "<tr align = 'center'>";	

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

				echo "<th colspan="."2".">Admin Actions</th>";

			//Insert Data	
				for ($row_num = 0; $row_num < $num_rows; $row_num++) {
					print "<tr>";
					$values  = array_values($row);
					for ($index = 0; $index < $num_fields; $index ++) {
						$value = htmlspecialchars($values[$index]);
						print "<td>" . $value . "</td>";
					}
					print "<td><button class="."editProduct".">Edit</button></td>";
                	print "<td><button class="."deleteProduct".">Delete</button></td>";
					print "</tr>";
					
					$row = mysqli_fetch_assoc($result);
				}
			}

			else {
				print "There were no such rows in the table <br />";
			}

			print "</table>";

		
			mysqli_close($conn);

		?>

		<button class="createProduct">Create Product</button>
		</div>
		 <br/>
        </div> <!-- End wrapper -->
    </div> <!-- End content -->
</body>
</html>



