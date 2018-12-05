<?php
	//submit button
	if(isset($_POST['submit']))
	{
		session_start();
		//Connect to the database
		$quan = intval($_POST['Quantity-'.$Item_ID]);
		$user_id = $_SESSION["employeeId"];	
		$mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
		$total =0;
		$role = $_SESSION["userrole"];	
		mysqli_query($mysqli,"INSERT INTO Orders Values(NULL,NULL,'Pending',CURDATE(), TIMESTAMPADD(WEEK,1,CURDATE()),$user_id,0);");
		
		
		$query4 = mysqli_query($mysqli,"SELECT MAX(Order_id) FROM Orders; ");
		$row = mysqli_fetch_Row($query4);
		$OrId = $row[0];
		
		foreach($_POST as $key => $value)
		{
			
			if($value>0)
			{
				$idnum = trim($key,'Quantity-');
				
				$query2 = mysqli_query($mysqli,"SELECT Prod_Price  FROM Product WHERE Prod_id = ". $idnum."; ");
				$row = mysqli_fetch_Row($query2);
				$price = $row[0];
			
				$total += $value * $price;
				$query6 = "INSERT INTO Order_Details VALUES(".$OrId.",".$value.",".$idnum.");";
				//var_dump($query6);
				mysqli_query($mysqli,$query6);
				
				//echo $query;
				//echo $query3;
			}
			
		}
		mysqli_query($mysqli,"UPDATE Orders SET Order_Total = ".(float)$total." where Order_id = ".$OrId.";");
		
        
		//$query1 = mysqli_query($mysqli,"INSERT INTO Orders Values(22,NULL,'Pending','2018-12-03','2018-12-10',103,521.00);");
		//$query2 =  mysqli_query($mysqli,"INSERT INTO Order_Details VALUES(22,$quan,23244);");
		
	if($role==1)
        	header('location: userHome.php');
	else if(($role==2)||($role==3))
		header('location: managerHome.php');
	else
		echo "ERROR. Please sign in";
		
		
	}
	?>
	
