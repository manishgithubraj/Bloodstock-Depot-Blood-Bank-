<?php
  require_once('connectvars.php');

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['don_emailid'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

      // Grab the user-entered log-in data
      $donor_emailid = mysqli_real_escape_string($dbc, trim($_POST['don_emailid']));
      $donor_password = mysqli_real_escape_string($dbc, trim($_POST['don_password']));

      if (!empty($donor_emailid) && !empty($donor_password)) {
        // Look up the username and password in the database
        $query = "SELECT emailid, password FROM donor WHERE emailid = '$donor_emailid' AND password = SHA('$donor_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['don_emailid'] = $row['don_emailid'];
          $_SESSION['don_password'] = $row['don_password'];
          setcookie('don_emailid', $row['don_emailid'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          setcookie('don_password', $row['don_password'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/donor.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  }
?>

<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Donor - Log In</title>
  <style>

    .one{
      margin: 12% 10% 10% 10% ;
    }

    .first{
      border-width: 3px 3px 3px 3px;
      border-style: solid;
      border-color: #bf474d ;
      border-radius: 15px;
      background-color: #bf474d ;
      color: white;
      padding: 20px;
      height: 35%;
      width: 35%;
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
                <a class="nav-link" href="contact.html" target="_blank">Contact Us</a>
              </li>
            </ul>
          </div>
        </div>
  </nav>


  <center>
  <div class="one first">

    <h3>Donor - Log In</h3>

<?php
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['don_emailid'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <table>
        <tr>
          <td>
            <label for="emailid">Email ID:</label>
          </td>
          <td>
            <input type="email" name="don_emailid" placeholder="Email ID" value="<?php if (!empty($donor_emailid)) echo $donor_emailid; ?>" /><br />
          </td>
        </tr>
        <tr>
          <td>
            <label for="password">Password:</label>
          </td>
          <td>
            <input type="password" name="don_password" placeholder="Password"/>
          </td>
        </tr>
      </table>
    </fieldset>
    <br>
    <input type="submit" value="Log In" name="submit" />
  </form>

<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['don_emailid'] . '.</p>');
  }
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
