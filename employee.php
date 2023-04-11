<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Connecting Vehicle Dashboard</title>
</head>
<body>
    <?php
    $EName = $_POST["ename"];
    $EPhNumber = $_POST["pno"];
    $EAddress = $_POST["address"];
    $EJDate = $_POST["jdate"];
    $con = mysqli_connect("localhost","root","");
	if(mysqli_connect_errno()){
        print("Failed to connect to the DB : ".mysqli_connect_error());
        exit();
    }
    else
        print("Connection to MySQL Database successful!");
    
	mysqli_select_db($con,"TRAVEL");
    if(isset($_POST["add"])){
        $query = "INSERT INTO EMPLOYEE (ENAME, EPHONE, EADDRESS, EJDATE) VALUES('$EName','$EPhNumber','$EAddress','$EJDate')";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        print("Values have been inserted successfully into the database!");
    }
    if(isset($_POST["modify"])){
        $query = "UPDATE EMPLOYEE SET ENAME = '$EName', EPHONE = '$EPhNumber', EADDRESS = '$EAddress', EJDATE = '$EJDate' WHERE  EPHONE= '$EPhNumber'";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        print("Values have been successfully updated in the database!");
    }
    if(isset($_POST["delete"])){
        $query = "DELETE FROM EMPLOYEE WHERE EPHONE= '$EPhNumber'";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        print("Values have been deleted successfully from the database!");
    }
    if(isset($_POST['display'])){
        $query="SELECT * FROM EMPLOYEE";
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
        echo"<th>EMPLOYEE ID</th>";
        echo"<th>EMPLOYEE NAME</th>";
        echo"<th>ADDRESS</th>";
        echo"<th>PHONE NUMBER</th>";
        echo"<th>JOIN DATE</th>";
        echo"</tr>";
        while($row = mysqli_fetch_array($result)){
            echo"<tr>";
            echo"<td>".$row["EID"]."</td>";
            echo"<td>".$row["ENAME"]."</td>";
            echo"<td>".$row["EADDRESS"]."</td>";
            echo"<td>".$row["EPHONE"]."</td>";
            echo"<td>".$row["EJDATE"]."</td>";
            echo"</tr>";
        }
        echo"</table>";
        }
    mysqli_close($con);
    ?>
</body>
</html>         