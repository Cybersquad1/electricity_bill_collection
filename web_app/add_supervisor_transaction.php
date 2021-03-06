<?php
include('api/config/conn.php');
date_default_timezone_set('Asia/Kolkata');
session_start();
if(isset($_SESSION["user_id"])){

}
else{
  header("Location: index.php");
}


if(isset($_POST["btn"])){
  $supervisor_id = $_POST["supervisor_id"];
  $amount = $_POST["amount"];
  $date_time = date("Y-m-d h:i:sa");

  $q = "SELECT * FROM supervisor WHERE user_id='$supervisor_id'";
  $r = mysqli_query($conn,$q);
  if(mysqli_num_rows($r) == 0){
    ?><script type="text/javascript">alert("Invalid Supervisor ID");</script><?php
  }
  else{
    $row = mysqli_fetch_assoc($r);
    $cash_in_hand = $row["cash_in_hand"] - $amount;
    // Update supervisor table
    $q = "UPDATE supervisor SET cash_in_hand = '$cash_in_hand' WHERE user_id='$supervisor_id'";
    mysqli_query($conn,$q);

    // Insert data in transaction table
    $q = "INSERT INTO supervisor_admin_transaction (supervisor_id,amount,date_time) VALUES ('$supervisor_id','$amount','$date_time')";
    $r = mysqli_query($conn,$q);
    if($r){
      ?><script type="text/javascript">alert("Successfully Data Inserted");</script><?php
    } 
    else{
      ?><script type="text/javascript">alert("Something went wrong. Please try again");</script><?php
    } 
  }
  
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Transaction</title>
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>


    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Add Supervisor Transaction</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target=".col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="home.php">Admin<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="supervisor.php">Supervisors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="collector.php">Collectors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="consumer.php">Consumers</a>
            </li>
          </ul>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="supervisor_admin_transaction.php">Supervisor - Admin Transaction</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="supervisor_collector_transaction.php">Supervisor - Collector Transaction</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="collector_consumer_transaction.php">Collector - Consumer Transaction</a>
            </li>
          </ul>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="add_supervisor_transaction.php">Add Supervisor Transaction</a>
            </li>
          </ul>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="add_supervisor.php">Add SuperVisor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_collector.php">Add Collector</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_consumer.php">Add Consumer</a>
            </li>
          </ul>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </nav>

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Enter details of New Supervisor Transaction</h1>

          <form class="col-lg-3" method="POST">
            <div class="form-group" >
              <label for="email">Supervisor ID:</label>
              <input type="text" class="form-control" name="supervisor_id" required autofocus>
            </div>
            <div class="form-group">
              <label for="pwd">Amount:</label>
              <input type="number" class="form-control" name="amount" required="">
            </div>
            <input type="submit" class="btn btn-default" name="btn">

          </form>
        </main>
      </div>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
</body>
</html>