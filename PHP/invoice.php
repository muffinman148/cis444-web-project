<!DOCTYPE html>
<!--Invoice for submitted order  -->
<html lang = "en">
<head>
<?php
	$order_id=$_POST['id'];
	echo "<title>Invoice #$order_id</title>";
?>
    <meta charset = "utf-8" />
    <link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css">	
    <img src="../Images/logo2.png" alt = "logo" id = "logo" class="topleft"> 
	<nav class="navigation">
        <a href="managerHome.php">Home</a> 
		<a href="Budget.php">View Budget</a>
		<a href="login.html">Sign Out</a>
	</nav>
</head>
<body>
<br>
<br>
<br>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
			<td class="title"><img src="../Images/logo2.png" style="width:100%; max-width:300px;"></td>
                        <td class = "info">
			<?php
				//Get the order ID from the order that was posted from the home page..
				$order_id= $_POST['id'];
				//Connect to the database
				$mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
                                if(mysqli_connect_errno())
                                {
					//Print error if there is trouble connecting to the database
                                        echo "Error - Cannot connect";
                                }
				else
				{
					//Collect Order Info
					$query1 = mysqli_query($mysqli,"SELECT * FROM Orders WHERE Order_id=$order_id;");
					$orderInfo = mysqli_fetch_Row($query1);
					$order_submit_date = $orderInfo[3];
					$order_due_date=$orderInfo[4];
					$order_status = $orderInfo[2];
					$order_Notes = $orderInfo[1];
					$emp_id= $orderInfo[5];
					$order_total= $orderInfo[6];
					//Collect Employee Info
					$query2= mysqli_query($mysqli,"SELECT * FROM Employee WHERE Emp_Id=$emp_id;");
					$employeeInfo = mysqli_fetch_Row($query2);
					$employee_name = $employeeInfo[1];
					echo "<b>Order #</b> $order_id<br>";
					echo "<b>Created </b> $order_submit_date<br>";
					echo "<b>Due: </b> $order_due_date<br>";
					echo "<b>Submitted By: </b> $employee_name <br>";
					echo "<b>Status: </b> $order_status<br>";
					echo "<b>Notes: </b> $order_Notes <br>";
					//Collect Order Detail Information. Loop through each product in the order and get that product's info
					$query3= mysqli_query($mysqli,"SELECT * FROM Order_Details WHERE Detail_Order_Id=$order_id;");
					$currentLineNumber = 1;
					//Print the table headings..
					echo "</td></tr></table></td></tr>";
					echo "<tr class=\"heading\"><td> Line Number</td><td>Product Name</td><td>Product Description</td><td>Price</td><td>Quantity</td></tr>";
					//Loop while ther are products in the order...
					while($row = mysqli_fetch_Row($query3))
                                        {
						//Get product variables from order_details table
						$product_ID = $row[2];
						$quantity= $row[1];
						//Search the product table for the current product ID in the order details table and store variables about the product
						$query4 = mysqli_query($mysqli,"SELECT * FROM Product WHERE Prod_id=$product_ID;");
						$productInfo = mysqli_fetch_Row($query4);
						$price = $productInfo[3];
						$description = $productInfo[1];
						$name= $productInfo[2];
						//Print the row 
						echo "<tr class=\"item\"><td>$currentLineNumber</td><td>$name</td><td>$description</td><td>$$price</td><td>$quantity</td></tr>";
						//Increment the line number
						$currentLineNumber++;
					}//While
					//Print the total price
					echo "<tr class=\"total\"<td></td><td></td><td></td><td></td><td><b>Total: $$order_total</b></td></tr>";	
					echo "</div><br><br><br></body></html>";
				}
			?>
				
