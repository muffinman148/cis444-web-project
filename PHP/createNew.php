<!DOCTYPE html>
<!-- Create Order -->
<html lang = "en">
<head>
	<title> Create Requests </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css">
	<img src="../Images/logo2.png" alt="logo" class="topleft">
	<nav class="navigation">
		<a href="managerHome.php">Home</a>
		<a href="login.php">Sign Out</a>
	</nav>
</head>
<body>
	<div class="content">
		<div class="wrapper">

<?php
			$mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
				if(mysqli_connect_errno())
				{				
					echo "Error - Cannot connect";
				}
				else
				{
					echo"<h1>Create Order</h1><form method =\"post\" id = \"createNewInvoice\" action = \"subtest.php\">";

			
						echo"<table class= form>
							<tr>
							<th>Item ID</th>
							<th>Item Name</th>
							<th>Item Description</th>
							<th>Item Price</th>
							<th>Item Quantity</th>
			
							</tr>";
					//pull the items from the product table
					$query = mysqli_query($mysqli,"SELECT * FROM Product;");
					if(!$query){
					echo "Error - The query could not be executed.";
					$error = mysql_error();
					echo "<p>" . $error . "</p>";
					exit;
					}
					
					while($row = mysqli_fetch_Row($query))
					{
							$Item_ID = $row[0];
							$Item_Name = $row[2];
							$Item_Description = $row[1];
							$Item_Price = $row[3];
							//start row
							echo "<tr>";
							//Fill row
							echo "<td>$Item_ID</td>";
							echo "<td>$Item_Name</td>";
							echo "<td>$Item_Description</td>";
							echo "<td>$Item_Price</td>";
							echo "<td><input type= \"number  \" name = \"Quantity-".$Item_ID."\" id = \"Quantity-".$Item_ID."\"value =\"0\"></input>";
							//End Row
							echo"</tr>";
							
							
					}
					
						echo "<td>
						
                              <input type=\"submit\" name=\"submit\" class=\"viewButton\" value=\"submit\"/></td>";
						echo"<td> <input type=\"submit\" name=\"cancel\" class=\"viewButton\" value=\"cancel\"/></td>";
					
					
				}
			
?>
		</table>
		</form>
        </div> <!-- End wrapper -->
    </div> <!-- End content -->
	<br><br>
</body>
</html>
	