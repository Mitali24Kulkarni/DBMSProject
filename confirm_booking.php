<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Connecting Vehicle Dashboard</title>
</head>
<body>
    <?php
    $tid = $_POST['tid'];
    $cid = $_POST['cid'];
    $eid = $_POST['eid'];
    $vid = $_POST['vid'];
    $dist = $_POST['dist'];
    $date = $_POST['date'];
    $amt = $_POST['amt'];
    $con = mysqli_connect("localhost","root","");
	if(mysqli_connect_errno()){
        print("Failed to connect to the DB : ".mysqli_connect_error());
        exit();
    }
    else
        print("Connection to MySQL Database successful!");
    
	mysqli_select_db($con,"TRAVEL");
    if(isset($_POST["confirm"])){
        $query = "INSERT INTO PAYMENT VALUES('$vid','$tid','$cid','$dist','$amt','$date')";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        $query = "INSERT INTO BOOKING VALUES('$vid','$tid','$cid','$date')";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        print("Values have been inserted successfully into the database!");
       
    }
    if(isset($_POST['display'])){
        $query="SELECT * FROM PAYMENT";
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
        echo"<th>TOUR ID</th>";
        echo"<th>CUSTOMER ID</th>";
        echo"<th>DISTANCE TRAVEL</th>";
        echo"<th>AMOUNT</th>";
        echo"<th>DATE</th>";
        echo"</tr>";
        while($row = mysqli_fetch_array($result)){
            echo"<tr>";
            echo"<td>".$row["VID"]."</td>";
            echo"<td>".$row["TID"]."</td>";
            echo"<td>".$row["CID"]."</td>";
            echo"<td>".$row["DISTANCE_TRAVEL"]."</td>";
            echo"<td>".$row["AMOUNT"]."</td>";
            echo"<td>".$row["PDATE"]."</td>";
            echo"</tr>";
        }
        echo"</table>";
        }
        $query="SELECT * FROM BOOKING";
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
        echo"<th>TOUR ID</th>";
        echo"<th>CUSTOMER ID</th>";
        echo"<th>DATE</th>";
        echo"</tr>";
        while($row = mysqli_fetch_array($result)){
            echo"<tr>";
            echo"<td>".$row["VID"]."</td>";
            echo"<td>".$row["TID"]."</td>";
            echo"<td>".$row["CID"]."</td>";
            echo"<td>".$row["BDATE"]."</td>";
            echo"</tr>";
        }
        echo"</table>";
    mysqli_close($con);
    ?>
</body>
</html>    