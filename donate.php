<?php

	require_once('connectvars.php');

		$dbc = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
		$fname = $_POST['fname'] ;
		$bdg = $_POST['bdg'] ;
		$mno = $_POST['mno'] ;
		$state = $_POST['state'] ;
		$city = $_POST['city'] ;
		$units = $_POST['units'] ;
		$disease = $_POST['disease'] ;
		$emailid = $_POST['email'] ;

		if (!empty($fname) && !empty($bdg) && !empty($mno) && !empty($state) && !empty($city) && !empty($units) && !empty($disease) && !empty($emailid)) {
			$query = "INSERT INTO donate(full_name, bloodgrp, mobile_number, state, city, units, disease, emailid) VALUES ('$fname', '$bdg', '$mno', '$state', '$city',  '$units', '$disease', '$emailid')";
			
			mysqli_query($dbc, $query);
			mysqli_close($dbc);
			echo "<scrip>Your information has been successfully entered.</scrip>";
			exit();
		}
		else{
			if(empty($fname)){
				echo 'You have not mentioned your full name.';
			}
			else if(empty($bdg)){
				echo 'You have not mentioned your blood group.';
			}
			else if(empty($mno)){
				echo 'You have not mentioned your mobile number.';
			}
			else if(empty($state)){
				echo 'You have not mentioned your state.';
			}
			else if(empty($city)){
				echo 'You have not mentioned your city.';
			}
			else if(empty($units)){
				echo 'You have not mentioned the number of units of blood you donate.';
			}
			else if(empty($emailid)){
				echo 'You have not mentioned your email id.';
			}
		}
	
?>