<?php
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
?>
