<?php
session_start();

// If the session vars aren't set, try to set them with a cookie
if (!isset($_SESSION['don_emailid'])) {
  if (isset($_COOKIE['don_emailid']) && isset($_COOKIE['don_password'])) {
    $_SESSION['don_emailid'] = $_COOKIE['don_emailid'];
    $_SESSION['don_password'] = $_COOKIE['don_password'];
  }
}
?>

<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Donor - login or sign up</title>
  <style>
    .one {
      margin: 15% 10% 10% 10%;
    }

    .first {
      border-width: 3px 3px 3px 3px;
      border-style: solid;
      border-color: #bf474d;
      border-radius: 15px;
      background-color: #531213;
      color: whitesmoke;
      padding: 20px;
      height: 35%;
      width: 35%;
    }

    input{
      margin: 0;
      font-family: Georgia, 'Times New Roman', Times, serif;
      font-size: inherit;
      line-height: inherit;
      color: black;
      
    }
    h3 {
      font-family:Verdana, Geneva, Tahoma, sans-serif;
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
            <a class="nav-link" href="login_signup_donor.php" target="_blank">Donor</a>
          </li>
  
          <li class="nav-item">
            <a class="nav-link" href="contact.html" target="_blank">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <center>
    <div class="one first">

      <h3>Donor - login or signup</h3>
      <?php
      require_once('connectvars.php');

      // Generate the navigation menu
      if (isset($_SESSION['don_password'])) {
        echo '&#10084; <a href="viewprofile.php">View Profile</a><br />';
        echo '&#10084; <a href="editprofile.php">Edit Profile</a><br />';
        echo '&#10084; <a href="logout_donor.php">Log Out (' . $_SESSION['don_emailid'] . ')</a>';
        echo '&#10084; <a href="delete_account.php">Delete Account (' . $_SESSION['don_emailid'] . ')</a>';
      } else {

        echo "<input type='button' value='Log In' onclick='login()'>";
        echo "<script> function login(){ 
          window.location.href='login_donor.php'; 
        }
        </script>";
        echo "\n\n";
        echo "<input type='button' value='Sign Up' onclick='signup()'>";
        echo "<script> function signup(){ 
          window.location.href='signup_donor.php'; 
        }
        </script>";
      }

      // Connect to the database 
      $dbc = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

      // Retrieve the user data from MySQL
      $query = "SELECT emailid, password FROM donor WHERE emailid = 'don_emailid' AND password = 'don_password'";
      $data = mysqli_query($dbc, $query);

      mysqli_close($dbc);
      ?>

    </div>
  </center>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom" id="footer">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"> &copy; BloodBank Management System</a>
    </div>
  </nav>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>