<?php
	//Use same session
	session_start();

	//Approve Button Clicked
	if (isset($_POST['approve']))	
	{
		/*Set the status of the requst to "Approved" With the following query: UPDATE Orders SET Order_Status='Approved' WHERE Order_id=x;*/
		$order_id=$_POST['id'];
		//Connect to the database
        	$mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
		//Execute the query and use the order_ID obtained via post
		$query1 = mysqli_query($mysqli,"UPDATE Orders SET Order_Status='Approved' WHERE Order_id=$order_id;");	
	
		//Alert the user that the request has been approved
		echo"<script>
		if(window.confirm('Sucessfully Approved Request $order_id.'))
			location.href = 'managerHome.php';
		</script>";

	}
	//Deny Button Clicked
	else if(isset($_POST['deny']))
	{
		/*Set the status of the requst to "Denied" With the following query: UPDATE Orders SET Order_Status='Approved' WHERE Order_id=x;*/
		$order_id=$_POST['id'];
                //Connect to the database
		$mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
                //Execute the query and use the order_ID obtained via post
                $query1 = mysqli_query($mysqli,"UPDATE Orders SET Order_Status='Denied' WHERE Order_id=$order_id;");		
		
		//Alert the user that the request has been approved
                echo"<script>
                if(window.confirm('Sucessfully Denied Request #$order_id.'))
                        location.href = 'managerHome.php';
                </script>";
	}
	//Adding a comment
	else if(isset($_POST['comment']))
	{
		$order_id=$_POST['id'];
		$the_comment=$_POST['theComment'];
		//Connect to the database
                $mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
                //Execute the query and use the order_ID obtained via post
                $query1 = mysqli_query($mysqli,"UPDATE Orders SET Order_Notes='$the_comment' WHERE Order_id=$order_id;");

                //Alert the user that the request has been approved
                echo"<script>
                if(window.confirm('Sucessfully added comment to Request #$order_id.'))
                        location.href = 'managerHome.php';
                </script>";
	}
	//Cancel Request
	else if(isset($_POST['cancel']))
        {
		//Set the order ID to the order ID of the request clicked
		$order_id=$_POST['id'];
		//Connect to the database
                $mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
                //Delete all info from Order_Details
		$query1 = mysqli_query($mysqli,"DELETE FROM Order_Details WHERE Detail_Order_Id=$order_id;");
		//Execute the query and delete the request from the database since it was cancelled..
		$query2 = mysqli_query($mysqli,"DELETE FROM Orders WHERE Order_id=$order_id;");
		
		//Alert the user that the request has been cancelled..
		echo"<script>
                if(window.confirm('Sucessfully cancelled Request #$order_id.'))
                        location.href = 'userHome.php';
                </script>";		
	}
	//Manager search
	else if(isset($_POST['msearch']))
        {
		$search_id=$_POST['searchBox'];
		if(!is_numeric($search_id))
		{
			echo"<script>
                	if(window.confirm('Error. Invalid OrderID entered. Please enter an integer value of a valid OrderID. Press OK to return to the homepage.'))
                        	location.href = 'managerHome.php';
                	</script>";
		}
		else
		{
			/*At this point we know that the Order_Id entered by the Manager is a valid integer value. Now we check if this order exists in the database*/
			//Connect to the database
                	$mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
                	//Check to see if the value entered is a valid order ID
                	$query1 = mysqli_query($mysqli,"SELECT EXISTS(SELECT * from Orders WHERE Order_Id=$search_id);");
			$row = mysqli_fetch_Row($query1);
			$quantity = $row[0];
			/*If the OrderID is not found in the database alert the user and return home*/
			if($quantity==0)
			{
				echo"<script>
	                        if(window.confirm('Error. The OrderID That you entered does not exist. Press OK to return to the homepage.'))
        	                        location.href = 'managerHome.php';
                	        </script>";

			}
			/*If a valid OrderID is entered, pull up the invoice for that OrderID*/
			else
			{
				/*Echo HTML form and use javascript to automatically submit the form*/
				echo "<form id=\"f1\" action=\"invoice.php\" method=\"post\">
				<input type=\"hidden\" name=\"id\" value=\"$search_id\"/></form>
				<script type=\"text/javascript\">
    				document.getElementById('f1').submit();
				</script>";
			}
		}
	}
	//User Search
	else if(isset($_POST['ssearch']))
        {
		$search_id=$_POST['searchBox'];
                if(!is_numeric($search_id))
                {
                        echo"<script>
                        if(window.confirm('Error. Invalid OrderID entered. Please enter an integer value of a valid OrderID. Press OK to return to the homepage.'))
                                location.href = 'userHome.php';
                        </script>";
                }
                else
                {
                        /*At this point we know that the Order_Id entered by the Manager is a valid integer value. Now we check if this order exists in the database*/
                        //Connect to the database
                        $mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
                        //Set the user ID to current user. Will change to SESSION later
			$userID=$_POST['theUserId'];
			//Run query to check if this User can access this order if it exists
                        $query1 = mysqli_query($mysqli,"SELECT EXISTS(SELECT * from Orders WHERE Order_Id=$search_id AND Order_Emp_Id=$userID);");
                        $row = mysqli_fetch_Row($query1);
			$quantity = $row[0];
                        /*If the OrderID is not found in the database alert the user and return home*/
                        if($quantity==0)
                        {
                                echo"<script>
                                if(window.confirm('Error. The OrderID That you entered either does not exist or you do not have access. Press OK to return to the homepage.'))
                                        location.href = 'userHome.php';
                                </script>";

                        }
                        /*If a valid OrderID is entered, pull up the invoice for that OrderID*/
                        else
                        {
                                /*Echo HTML form and use javascript to automatically submit the form*/
                                echo "<form id=\"f1\" action=\"invoice.php\" method=\"post\">
                                <input type=\"hidden\" name=\"id\" value=\"$search_id\"/></form>
                                <script type=\"text/javascript\">
                                document.getElementById('f1').submit();
                                </script>";
                        }
                }
		


	}

?>
