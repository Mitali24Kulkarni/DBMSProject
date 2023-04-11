<?php
 $con = mysqli_connect("localhost","root","");
 if(mysqli_connect_errno()){
     print("Failed to connect to the DB : ".mysqli_connect_error());
     exit();
 }
 else
     print("Connection to MySQL Database successful!");
mysqli_select_db($con,"TRAVEL");
if(isset($_POST["query1"])){
    $query = "SELECT COUNT(*) TOTAL FROM BOOKING B, VEHICLE V WHERE V.VID = B.VID AND B.BDATE LIKE '2022-__-__'";
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
    while($row = mysqli_fetch_array($result)){
        echo"<p>".$row["TOTAL"]."</p>";
    }
}
if(isset($_POST["query2"])){
    $query = "SELECT AMOUNT FROM PAYMENT WHERE PDATE='2022-11-30'";
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
    while($row = mysqli_fetch_array($result)){
        echo"<p>".$row["AMOUNT"]."</p>";
    }
}
if(isset($_POST["query3"])){
    $query = "SELECT COUNT(*) CARCNT, AMOUNT FROM VEHICLE V, PAYMENT P WHERE P.VID = 10 AND V.VNAME = 'ABC' AND P.PDATE BETWEEN '2022-__-__' AND '2022-DEC-31'";
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
    while($row = mysqli_fetch_array($result)){
        echo"<p>".$row["CARCNT"]."</p>";
        echo"<p>".$row["AMOUNT"]."</p>";
    }
}
if(isset($_POST["query4"])){
    $month = explode("/","PDATE");
    $query = "SELECT AMOUNT FROM PAYMENT WHERE VID = 10 AND  PDATE BETWEEN '2022-11-%' AND '2022-12-%' " ;
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
    while($row = mysqli_fetch_array($result)){
        echo"<p>".$row["AMOUNT"]."</p>";
    }
}
mysqli_close($con);
?>