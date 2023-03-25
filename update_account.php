<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <title>Update Account</title>
    <style>
    .one{
      margin:3% 7% 3% 7% ;
    }

    .first{
      border-width: 3px 3px 3px 3px;
      border-style: solid;
      border-color: #bf474d ;
      border-radius: 15px;
      background-color: #bf474d ;
      color: white;
      padding: 20px;
      width: 50%;
    }

    td{
            padding: 8px;
        }

    input, textarea, select{
            border: 2px solid white;
            background-color: white;
            border-radius: 5px;
    }

    input{
      height: 90%;
      width: 90%;
      color: black;
    }

    select{
      height: 90%;
      width: 90%;
      color: black;
    }
    </style>
</head>
<body>

    <nav id="nabvar-custom" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">BloodBank Management System</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="logout_donor.php">Logout</a>
              </li>
          </div>
        </div>
    </nav>


  <center>
  <div class="one first">

      <h3>Blood Donation Form</h3>
      <br>
      <form action="donate.php" method="POST">
        <table>
          <tr>
            <td>
              <label for="fname">Full Name :</label>
            </td>
            <td>
              <input type="text" name="fname" id="fname">
            </td>
          </tr>
          <tr>
            <td>
              <label for="bdg">Blood Group :</label>
            </td>
            <td>
              <select name="bdg" id="bdg">
                <option value="select">---Select---</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
             </select>
            </td>
          </tr>
          <tr>
            <td>
              <label for="mno">Mobile Number :</label>
            </td>
            <td>
              <input type="tel" name="mno" id="mno">
            </td>
          </tr>
          <tr>
            <td>
              <label for="state">State :</label>
            </td>
            <td>
              <input type="text" name="state" id="state">
            </td>
          </tr>
          <tr>
            <td>
              <label for="city">City :</label>
            </td>
            <td>
              <input type="text" name="city" id = "city">
            </td>
          </tr>
          <tr>
            <td>
              <label for="units">No. Of Units:</label>
            </td>
            <td>
              <input type="text" name = "units" id = "units">
            </td>
          </tr>
          <tr>
            <td>
              <label for="email">Email ID:</label>
            </td>
            <td>
              <input type="email" id="email" name="email">
            </td>
          </tr>
          <tr>
            <td>
              <label for="disease">Disease (if any):</label>
            </td>
            <td>
              <textarea name="disease" id="" cols="29" rows="3"></textarea>
            </td>
          </tr>
        </table>
        <button type="submit" class="btn btn-primary" onclick="window.location.href='donate.php';">Submit</button>
      </form>


      </div></center>

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom" id="footer">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> &copy; BloodBank Management System</a>
          
        </div>
      </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php

require_once('connectvars.php');

session_start();

// initializing variables
        $fname = $_POST['fname'] ;
		$bdg = $_POST['bdg'] ;
		$mno = $_POST['mno'] ;
		$state = $_POST['state'] ;
		$city = $_POST['city'] ;
		$units = $_POST['units'] ;
		$disease = $_POST['disease'] ;
        $emailid = $_POST['email'] ;

// connect to the database
$dbc = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);


// first check the database to make sure 
// a user already exist with the same username and/or email
$user_check_query = "SELECT * FROM donate WHERE emailid ='$emailid'  LIMIT 1";
$result =  mysqli_query($dbc, $user_check_query);
if ($result === FALSE) 
{
die(mysqli_error($connect));
}
$user = mysqli_fetch_assoc($result);

if ($user) 
{ 
    // if user exists update the details in the database
    $query =  "UPDATE donate SET full_name='$fname', bloodgrp='$bdg', mobile_number='$mno',
               state='$state', city = '$city', units = '$units', disease = '$disease', emailid = '$emailid' where emailid='$emailid'";
    $result1 = mysqli_query($db, $query);
    mysqli_close($dbc);
	echo "<scrip>Your information has been successfully updated.</scrip>";
	exit();

}

  // Register user if there are no user with the given username and email
  else 
  {
      echo "<script>Your information can not be updated.</script>";
  }
?>