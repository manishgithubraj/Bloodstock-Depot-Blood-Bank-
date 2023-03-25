<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Donor - Sign Up</title>
  <style>

    .one{
      margin: 5% 7% 5% 7% ;
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

    input{
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
                <a class="nav-link" href="login_signup_donor.php" target="_blank">Donor</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="search_blood.php" target="_blank">Search Blood</a>
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

  <h3>Donor - Sign Up</h3>

<?php
  require_once('connectvars.php');

  // Connect to the database
  $dbc = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $emailid = mysqli_real_escape_string($dbc, trim($_POST['don_emailid']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['don_password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['don_password2']));

    if (!empty($emailid) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM donor WHERE emailid = '$emailid'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO donor (name, emailid, password) VALUES ('$name' ,'$emailid', SHA('$password1'))";
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login_donor.php">log in</a>.</p>';

        mysqli_close($dbc);
        exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this Email ID. Please use a different Email ID.</p>';
        $emailid = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
  }

  mysqli_close($dbc);
?>


  <p>Please enter your Email ID and desired password to sign up to Donor.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Registration Info</legend>
      <table>
        <tr>
          <td>
            <label for="name">Name:</label>
          </td>
          <td>
            <input type="text" name="name" id="name" placeholder="Name">
          </td>
        </tr>
        <tr>
          <td>
            <label for="emailid">Email ID:</label>
          </td>
          <td>
            <input type="email" id="don_emailid" name="don_emailid" placeholder="Email ID" value="<?php if (!empty($emailid)) echo $emailid; ?>" /><br />
          </td>
        </tr>
        <tr>
          <td>
            <label for="password1">Password:</label>
          </td>
          <td>
            <input type="password" id="don_password1" name="don_password1" placeholder="Password"/><br />
          </td>
        </tr>
        <tr>
          <td>
            <label for="password2">Password (retype):</label>
          </td>
          <td>
            <input type="password" id="don_password2" name="don_password2" placeholder="Password(Retype)" /><br />
          </td>
        </tr>
      </table>
    </fieldset>
    <br>
    <input type="submit" value="Sign Up" name="submit" />
  </form>

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
