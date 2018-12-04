<!DOCTYPE html>
<!--Home Page for users -->
<html lang = "en">
<head>
    <title>User Home</title>
    <meta charset = "utf-8" />
    <link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css">	
    <img src="../Images/logo2.png" alt = "logo" id = "logo" class="topleft">
<?php
	session_start();
	
	require_once("menu.php");
	createMenu();
	
	echo "</head><body><div class=\"content\"><div class=\"wrapper\">";	

	$userName = $_SESSION["username"];
	$role = $_SESSION["userrole"];
	//Display completed table...
	echo "<h1> $userName's Pending Requests </h1>";
	//Search button
        echo "<table class=\"form\">
        <tr><form method=\"post\" action=\"handleRequest.php\"\><th colspan=3>Search For Order (Enter Order ID)</th></tr>
        <tr><td><input type=\"text\" name=\"searchBox\" id=\"searchBox\"/></td>
        <td><input type=\"submit\" name=\"ssearch\" class=\"viewButton\" value=\"Search\"/></td>
	<td><input type=\"hidden\" name=\"theUserId\" id=\"theUserId\" value=104 /></td></form>
        </tr></table>
        <br>";

	echo "<table class=\"form\" action=\"invoice.html\" style = \"font-style: normal\" id=\"User Pending Requests\">
                        <tr align=\"left\">
                                <th>Order ID</th>
                <th>Date Submitted</th>
                                <th>Date Due</th>
                <th>Order Amount</th>
                <th>Status</th>
                                <th>Cancel Order</th>
                                <th>View Order</th>
                        </tr>";
	//Connect to Database
	// $mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
    // My Local Database
    $mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","cis444");
                                if(mysqli_connect_errno())
                                {
                                        echo "Error - Cannot connect";
                                }
                                else
                                {
					//PENDING REQUEST TABLE		
			
					//Assuming user is ID 104. Will pull the userID from the session eventually..
                                        $user_id = 104;
					//Find the orders with status of "Pending" with the userID that matches the currently logged on user.
                                        $query1 = mysqli_query($mysqli,"SELECT * FROM Orders WHERE Order_Status = 'Pending' AND Order_Emp_Id=104;");
                                        //Looop while there are pending orders..
					while($row = mysqli_fetch_Row($query1))
                                        {
						//Store values from current order
						$order_id = $row[0];
						$date_submit = $row[3];
						$date_due = $row[4];
						$amount = $row[6];
						//Start row
						echo "<tr>";
						//Fill Row	
						echo "<td>$order_id</td><td>$date_submit</td><td>$date_due</td><td>$$amount</td><td>Pending</td>";
						//Cancel Button
                                                echo "<td><form method=\"post\" action=\"handleRequest.php\">
                                                         <input type=\"hidden\" name=\"id\" value=\"$order_id\"/>
                                                         <input type=\"submit\" name=\"cancel\" class=\"denyButton\" value=\"Cancel\"/></form></td>";
                                                //View button, post the order_id and pass to the invoice.php page to load the order details on that specific order...
                                                echo "<td><form method=\"post\" action=\"invoice.php\">
                                                         <input type=\"hidden\" name=\"id\" value=\"$order_id\"/>
                                                         <input type=\"submit\" name=\"approve\" class=\"viewButton\" value=\"View\"/></form></td></tr>";
					}
					//End the table
					echo " </table></div></div><br><br>";

					//COMPLETED REQUEST TABLE
					echo "<div class=\"content\"><div class=\"wrapper\">
                				<h1> $userName's Completed Requests</h1>
                				<table class=\"form\" style = \"font-style: normal\" id=\"User Completed Request\">
                        			<tr align=\"left\">
                    					<th>Order ID</th>
                    					<th>Date Submitted</th>
                                        		<th>Date Due</th>
                    					<th>Order Amount</th>
                    					<th>Status</th>
                                        		<th>View Order</th>
                                		</tr>";
					$query2 = mysqli_query($mysqli,"SELECT * FROM Orders WHERE Order_Status = 'Approved' AND Order_Emp_Id=104;");
					//Looop while there are approved orders..
                                        while($row = mysqli_fetch_Row($query2))
                                        {
						//Store values from current order
                                                $order_id = $row[0];
                                                $date_submit = $row[3];
                                                $date_due = $row[4];
                                                $amount = $row[6];
						//Start row
                                                echo "<tr>";
                                                //Fill Row
                                                echo "<td>$order_id</td><td>$date_submit</td><td>$date_due</td><td>$$amount</td><td>Approved</td>";
						//View button, post the order_id and pass to the invoice.php page to load the order details on that specific order...
                                                echo "<td><form method=\"post\" action=\"invoice.php\">
                                                         <input type=\"hidden\" name=\"id\" value=\"$order_id\"/>
                                                         <input type=\"submit\" name=\"approve\" class=\"viewButton\" value=\"View\"/></form></td></tr>";
					}
					//End the table
					echo "</table><br><br></div></div></body></html>";
				}
?>
