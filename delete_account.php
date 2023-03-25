<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Delete Account</title>
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
    <div class="one">
        <h3 class="text-center">Delete Account?</h3>
        <form action="" method="POST">
            <input type="submit" name="delete" value="Delete Account" class="form-control w-50 m-auto"><br>
            <input type="submit" name="dont_delete" value="Don't Delete Account" class="form-control w-50 m-auto">
        </form>
    </div>
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
$dbc = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

session_start();
$don_email_session = $_SESSION['emailid'];

if (isset($_POST['delete'])) {  
    $delete_query = "DELETE FROM donor WHERE emailid = '$don_email_session'";
    $result = mysqli_query($dbc, $delete_query);
    if ($result) {
        session_destroy();
        echo "<script>alert('Account deleted Successfully.')</script>";
        echo "<script>window.open('index.php'.'_self')</script>";
    }
}
if (isset($_POST['dont_delete'])) {
    echo "<script>window.open('donor.php','_self')</script>";
}
?>


<style>
        .one {
            margin: 10% 10% 0% 30%;
            border-width: 3px 3px 3px 3px;
            border-style: solid;
            border-color: #bf474d;
            border-radius: 15px;
            background-color: #bf474d;
            color: white;
            padding: 20px;
            height: 35%;
            width: 35%;
        }
    </style>