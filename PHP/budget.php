<!DOCTYPE html>
<!--Budget Page -->
<html lang = "en">
<head>
<title>Budget</title>
<meta charset = "utf-8" />
<link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css">
<img src="../Images/logo2.png" alt = "logo" id = "logo" class="topleft"> 

		<?php
                                
                                //Include File and call function to create navigation bar
                                require_once("menu.php");

				echo "</head><body><div class=\"content\"><div class=\"wrapper\">";

				$mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
                                if(mysqli_connect_errno())
                                {
                                        echo "Error - Cannot connect";
                                }
                                else
                                {
					 echo "<h1> Completed Requests </h1>";
                                        //Search button
                                        echo "<table class=\"form\">
                                        <tr><form method=\"post\" action=\"handleRequest.php\"\><th colspan=3>Search For Order (Enter Order ID)</th></tr>
                                        <tr><td><input type=\"text\" name=\"searchBox\" id=\"searchBox\"/></td><td>
                                        <td><input type=\"submit\" name=\"msearch\" class=\"viewButton\" value=\"Search\"/></td></form>
                                        </tr></table>
                                        <br>";
					
					echo "<table class=\"form\" action=\"invoice.php\" style = \"font-style: normal\" id=\"Completed Requests\">
                        		<tr align=\"left\">
                                		<th>Order ID</th>
                                		<th>Employee Name</th>
                                		<th>Department</th>
                                		<th>Date Submitted</th>
                                		<th>Date Due</th>
                                		<th>Amount</th>
						<th>Status</th>
                                		<th>View Order Details</th>
                        		</tr>";

		

                                        //Find the orders with status of "Approved". All managers can see completed requests from any employee so we select all orders...
                                        $query1 = mysqli_query($mysqli,"SELECT * FROM Orders WHERE Order_Status = 'Approved' OR Order_Status='Denied';");
                                        while($row = mysqli_fetch_Row($query1))
                                        {
						//Store Values
                                                $order_id = $row[0];
                                                $date_submit = $row[3];
                                                $date_due = $row[4];
                                                $amount = $row[6];
                                                $empID = $row[5];
						$status = $row[2];
                                                //Second Query needed for employee info
                                                $query2 = mysqli_query($mysqli,"SELECT Emp_Name,EMP_Department FROM Employee WHERE Emp_Id=$empID;");
                                                $row2 = mysqli_fetch_Row($query2);
                                                $empName = $row2[0];
                                                $empDepartment = $row2[1];
                                                //Start Row
                                                echo "<tr>";
						//Fill row
                                                echo "<td>$order_id</td>";
                                                echo "<td>$empName</td>";
                                                echo "<td>$empDepartment</td>";
                                                echo "<td>$date_submit</td>";
                                                echo "<td>$date_due</td>";
                                                echo "<td>$amount</td>";
						echo "<td>$status</td>";
						//View button, post the order_id and pass to the invoice.php page to load the order details on that specific order...
                                                echo "<td><form method=\"post\" action=\"invoice.php\">
                                                         <input type=\"hidden\" name=\"id\" value=\"$order_id\"/>
                                                         <input type=\"submit\" name=\"approve\" class=\"viewButton\" value=\"View\"/></form></td>";
                                                //End Row
                                                echo "</tr>";


					}
				}
	
		?>
	
	
		</table>
        </div> <!-- End wrapper -->
    </div> <!-- End content -->
</body>
</html>
