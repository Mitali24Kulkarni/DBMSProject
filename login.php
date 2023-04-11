<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP OF LOGIN PAGE</title>
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
    if(isset($_POST['new'])){
        header("Location: newuser.html");
    }
    $username = $_POST["username"];
    $passwd = $_POST["password"];
	mysqli_select_db($con,"TRAVEL");
    $query = " SELECT * FROM LOGINDETAILS where username = '$username' and password = '$passwd'";
    $result = mysqli_query($con, $query);
    if(mysqli_error($con)){
        print("Query could NOT be executed : ".mysqli_error($con));
        exit();
    }
    $row = mysqli_num_rows($result);
        if($row == 1){
            print("LOGIN SUCCESSFULL!");
            header("Location: travel_home_page.html");
        } 
        else
            echo "ERROR!! Sorry Given credentials do not match with our records";
    mysqli_close($con);
?>
</body>
</html>