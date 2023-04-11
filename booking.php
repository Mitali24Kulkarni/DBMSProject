<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Connecting Booking Dashboard</title>
</head>
<body>
    <?php
    $tid = $_POST['tid'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $sdate = $_POST['jdate'];
    $edate = $_POST['edate'];

    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
    $caddress = $_POST['address'];
    $cphone = $_POST['pno'];
    $con = mysqli_connect("localhost","root","");
	if(mysqli_connect_errno()){
        print("Failed to connect to the DB : ".mysqli_connect_error());
        exit();
    }
    else
        print("Connection to MySQL Database successful!");
    
	mysqli_select_db($con,"TRAVEL");
    if(isset($_POST["book"])){
        $query=" INSERT INTO CUSTOMER VALUES('$cid','$cname','$caddress','$cphone')";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        

        $query=" INSERT INTO TOUR VALUES('$tid','$source','$destination','$sdate','$edate')";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        }
        print("Values have been inserted successfully into the database!");
        header("Location: confirm_booking.html");
    }
    if(isset($_POST["modify"])){
        $query = "UPDATE BOOKING SET ENAME = '$EMP_Name', PHONE_NUMBER = '$EPhNumber', ADDRESS = '$EAddress', EJDATE = '$EJdate')";
        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit();
        } 
    }
    if(isset($_POST["delete"])){

        $result = mysqli_query($con,$query);
        if(mysqli_error($con)){
            print("Query could NOT be executed : ".mysqli_error($con));
            exit(); 
        }
    }
    if(isset($_POST['display'])){
        $query="SELECT * FROM TOUR";
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
        echo"<th>TOUR ID</th>";
        echo"<th>SOURCE</th>";
        echo"<th>DESTINATION</th>";
        echo"<th>START DATE</th>";
        echo"<th>END DATE</th>";
        echo"</tr>";
        while($row = mysqli_fetch_array($result)){
            echo"<tr>";
            echo"<td>".$row["TID"]."</td>";
            echo"<td>".$row["SOURCE"]."</td>";
            echo"<td>".$row["DESTINATION"]."</td>";
            echo"<td>".$row["SDATE"]."</td>";
            echo"<td>".$row["EDATE"]."</td>";
            echo"</tr>";
        }
        echo"</table>";
        }
        $query="SELECT * FROM CUSTOMER";
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
        echo"<th>CUSTOMER ID</th>";
        echo"<th>CUSTOMER NAME</th>";
        echo"<th>ADDRESS</th>";
        echo"<th>PHONE NUMBER</th>";
        echo"</tr>";
        while($row = mysqli_fetch_array($result)){
            echo"<tr>";
            echo"<td>".$row["CID"]."</td>";
            echo"<td>".$row["CNAME"]."</td>";
            echo"<td>".$row["CADDRESS"]."</td>";
            echo"<td>".$row["CPHONE"]."</td>";
            echo"</tr>";
        }
        echo"</table>";
    mysqli_close($con);
    ?>
</body>     
</html>          