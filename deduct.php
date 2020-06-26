<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "seamless";

$rfid = $_POST['rfid'];
$coupons = "1";
$coupons = (int)$coupons;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


try{
    $connect = mysqli_connect($host, $user, $password, $database);
} 
catch (mysqli_sql_exception $ex) {
    echo 'Error';
}


if(!empty($rfid))
{
    
    $search_Query = "SELECT * FROM codechef WHERE rfid = '$rfid'";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $rfid1 = $row['rfid'];
                $coupons1 = $row['coupons'];
                
                if ($coupons1 >= 0 ){
                    
                    $coupons1 = $coupons1-1;
                    
                    //update
                    $update_Query = "UPDATE `codechef` SET `coupons`='$coupons1' WHERE `rfid` = '$rfid1'";
                    try{
                        $update_Result = mysqli_query($connect, $update_Query);
        
                    if($update_Result){
                        if(mysqli_affected_rows($connect) > 0){
                            echo 'Data Updated';
                            }
                        else{
                            echo 'Data Not Updated';
                            }
                        }
                    }
                    catch (Exception $ex) {
                        echo 'Error Update '.$ex->getMessage();
                        }
                    }
                
                else {
                    echo 'Out of coupons';
                }
                }
            }
        
        else{
             
            echo "No RFID";
            }
        }
    }
    else{
        echo 'Result Error';
    }


micro.php – 
<html>

<head>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic-ext" rel="stylesheet">
  <style>
    table {
      overflow-y: scroll;
      height: 350px;
      width: 100%;
      background-color: white;
      border: solid 5px black;
      margin: 5px;
      padding: 8px;
      text-align: center;
      top: 0px;
    }

    body {
      min-width: 1000px;
      background-color: black;
      background-image: url("https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80");

      /* Full height */
      height: 100%;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .bg-text {
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/opacity/see-through */
      color: white;
      font-weight: bold;
      border: 3px solid #f1f1f1;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      height: 80%;
      width: 90%;
      padding: 20px;
      text-align: center;
    }

    .c1 {
      width: 90%;
      margin: 0;
      height: 350px;
      border-radius: 0.8rem;
      background-color: rgba(0, 0, 0, 0.6);
      display: inline-block;
      margin: 0 auto;

    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark" style="text-align:center;">
    <a class="navbar-brand" href="#" style="color:white; letter-spacing:5px; text-align:center; "><b>COUPON MANAGEMENT
        SYSTEM</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  </nav>
  <br>
  <div class="bg-text" style="text-align: center;">
    <h2 style="font-family: 'Lobster', cursive;">database : </h2>
    <br>
    <span style="font-size:16px;"> Search by name : <span><input type="text" name="name"
          style="border-radius:0.5rem;">&nbsp;&nbsp;&nbsp;&nbsp;

        <br> <br><br>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "seamless";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM codechef order by coupons DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table> <tr style="."height:20px; top:0; background-color:black; color: white;".">
                    <th>rfid</th>
                    <th>coupons</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                </tr>";
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["rfid"]."</td><td>".$row["coupons"]."</td><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
  </div>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>
