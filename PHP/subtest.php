<?php
	//submit button
	if(isset($_POST['submit']))
	{
		//Connect to the database
		$quan = intval($_POST['Quantity-'.$Item_ID]);
		//$_SESSION['employeeID'];
		$mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
		$total =0;
		foreach($_POST as $key => $value)
		{
			$mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
			
			if($value>0)
			{
				$idnum = trim($key,'Quantity-');
				
				$price = mysqli_query($mysqli,"SELECT Prod_Price  FROM Product; ");
				
				echo $price;
				$total += $value * $price;
			
				
				$query = "INSERT INTO Order_Details VALUES(".$value.",".trim($key, 'Quantity-').");";
				echo $query;
			}
			
		}
		echo "total: ".$total;
		die();
        $mysqli = mysqli_connect("localhost","group3","38IkUwFEhxfq","group3");
		//$query1 = mysqli_query($mysqli,"INSERT INTO Orders Values(22,NULL,'Pending','2018-12-03','2018-12-10',103,521.00);");
		$query2 =  mysqli_query($mysqli,"INSERT INTO Order_Details VALUES(22,$quan,23244);");
		
                
        header('location: http://cis444.cs.csusm.edu/group3/BusinessTracker/PHP/managerHome.php');
		
		
	}
	?>
	