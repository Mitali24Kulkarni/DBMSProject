<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Connecting Vehicle Dashboard</title>
</head>
<body>
    <?php
    $VehicleName = $_POST["vname"];
    $VehicleType = $_POST["vtype"];
    $Capacity = $_POST["capacity"];
    $RegNo = $_POST["register_number"];
    $con = mysqli_connect("localhost","root","");
	if(mysqli_connect_errno()){
        print("Failed to connect to the DB : ".mysqli_connect_error());
        exit();
    }
    else
        print("Connection to MySQL Database successful!");
    
	mysqli_select_db($con,"TRAVEL");
    if(isset($_POST["add"])){
        $query = "INSERT INTO VEHICLE (VNAME, CAPACITY, TYPE, REGNO) VALUES('$VehicleName','$Capacity','$VehicleType','$RegNo')";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        print("Values have been inserted successfully into the database!");

    }
    if(isset($_POST["modify"])){
        $query = "UPDATE VEHICLE SET VNAME = '$VehicleName', TYPE = '$VehicleType', CAPACITY='$Capacity',REGNO ='$RegNo' WHERE REGNO ='$RegNo'";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        print("Values have been successfully updated in the database!");
    }
    if(isset($_POST["delete"])){
        $query = "DELETE FROM VEHICLE WHERE REGNO='$RegNo'";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        print("Values have been deleted successfully from the database!");
    }
    if(isset($_POST['display'])){
    $query="SELECT * FROM VEHICLE";
    $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
    $rowCount = mysqli_num_rows($result);
    $fieldCount = mysqli_num_fields($result);
    
    printf("<br>There are %d rows and %d fields in the result",$rowCount,$fieldCount);
    if($rowCount == 0){
        echo "No tuples found for your query";
        exit();	
    }
	echo"<table>";
    echo"<tr>";
    echo"<th>VEHICLE ID</th>";
    echo"<th> VEHICLE NAME</th>";
    echo"<th> CAPACITY</th>";
    echo"<th> TYPE</th>";
    echo"<th> REGNO</th>";
    echo"</tr>";
    while($row = mysqli_fetch_array($result)){
        echo"<tr>";
        echo"<td>".$row["VID"]."</td>";
        echo"<td>".$row["VNAME"]."</td>";
        echo"<td>".$row["CAPACITY"]."</td>";
        echo"<td>".$row["TYPE"]."</td>";
        echo"<td>".$row["REGNO"]."</td>";
        echo"</tr>";
    }
    echo"</table>";
    }
    mysqli_close($con);
    ?>
</body>
</html>  