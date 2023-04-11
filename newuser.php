<!DOCTYPE html>
<html>
<head>
	<title> CONNECTION OF PHP</title>
</head>
<body>
	<?php
	$con = mysqli_connect("localhost","root","");
	if(mysqli_connect_errno()){
        print("Failed to connect to the DB : ".mysqli_connect_error());
        exit();
    }
    else
        print("Connection to MySQL Database successful!");
    
	mysqli_select_db($con,"TRAVEL");
	$user_id = $_POST['user_id'];
	$user_pwd = $_POST['user_pwd'];
    $newpwd = $_POST['repwd'];
	$query = "INSERT INTO LOGINDETAILS VALUES('$user_id','$user_pwd')";
    $result = mysqli_query($con,$query);
    if(mysqli_error($con)){
        print("Query could NOT be executed : ".mysqli_error($con));
		exit();
    }
	print("Dear " . $user_id . " your account has been created successfully!");
    header("Location: travel_login.html");
	?>
</body>
</html>