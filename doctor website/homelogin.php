<?php
	$servername = "localhost";
	// Replace the following with your own information
	$username = "M00842543Danie";
	$password = "I-play-pian0";
	$dbname = "M00842543Danie";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	  	die("Connection failed: " . mysqli_connect_error());
		exit();
	}
	// get info from form
	$username_form = $_POST['username'];
	$password_form = $_POST['password'];

	//HASHING
	//key for AES openSSL encryption for sensitive data
	$key = "FLkWvfVxbHF9I2Nslw8sUPpkjDq58P949k5LC4HV";

	//the openSSL encryption algorithm (used for hashing the passwords and other sensitive data in the database)
	function encryptstring($data,$key){
		$encryption_key = base64_decode($key);
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key,0,$iv);
		return base64_encode($encrypted.'::'.$iv);
	}
	//the openSSL decryption algorithm
	function decryptstring($data,$key){
		$encryption_key = base64_decode($key);
		list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data),2),2,null);
		return openssl_decrypt($encrypted_data, 'aes-256-cbc',$encryption_key,0,$iv);
	}


	/*
	$str = "Moreno";
	$temp = encryptstring($str, $key);
	echo $temp;
	$temp = decryptstring($temp, $key);
	echo $temp;
	*/
//--------------------------------------------------------------------------------------------------------------------------------------
	//if username and password fields have values, check each row of database
	if(isset($username_form, $password_form)){
		//USERNAME SANITIZE
		$username_form = filter_var($username_form, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		//PASSWORD SANITIZE
		$password_form = filter_var($password_form, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


		//SQL TO RETREIVE DATA
		//set sql statment
		$sql = "SELECT * FROM users";
		//get data from database
		$result = $conn->query($sql);
		//WHILE LOOP TO VERIFY USER
		while($row = $result->fetch_assoc()){
			//USERNAME VERIFICATION
			//decrypts username in database and matches it against the password provided by user.
			$userverify = False;
			$dec_username_db = decryptstring($row['username'],$key);
			if($dec_username_db == $username_form){
				//breaks if it is the same
				$userverify = True;
				break;
			}
			else{
				//continues if not
				continue;
			}
		}
//----------------------------------------------------------------------------------------------------------------------------------------
		//SQL TO RETREIVE DATA
		//set sql statment
		$sql = "SELECT * FROM users";
		//get data from database
		$result = $conn->query($sql);
		//WHILE LOOP TO VERIFY PASS
		while($row = $result->fetch_assoc()){
			//PASSWORD VERIFICATION
			//decrypts password in database and matches it against the password provided by user.
			$passverify = False;
			$dec_password_db = decryptstring($row['userpassword'],$key);
			if($dec_password_db == $password_form){
				//breaks if it is the same
				$passverify = True;
				$user_type = $row["user_type"];
				break;
			}
			else{
				//continues if not
				continue;
			}
		}
//-----------------------------------------------------------------------------------------------------------------------------------------
		//SQL TO RETREIVE DATA
		//set sql statment
		$sql = "SELECT * FROM users";
		//get data from database
		$result = $conn->query($sql);
		//WHILE LOOP TO CHECK CREDENTIALS AND DATABASE DATA
		while($row = $result->fetch_assoc()){
			//if username and pass match then check account type
			if($userverify == True & $passverify == True){
				if(decryptstring($row[username],$key) == $_POST['username']){
					//the value of the usertype variable and usertype data in database both have to match
					switch($user_type & $row["user_type"]){
						case "ADMIN":
							session_start();
							$_SESSION["userID"] = $row["userID"];
							$_SESSION["username"] = $_POST['username'];
							header("Location:adminpage.php");
							exit();
							break;
						case "DOCTOR":
							session_start();
							$_SESSION["userID"] = $row["userID"];
							$_SESSION["username"] = $_POST['username'];
							header("Location:doctorpage.php");
							exit();
							break;
						case "PATIENT":
							session_start();
							$_SESSION["userID"] = $row["userID"];
							$_SESSION["username"] = $_POST['username'];
							header("Location:patientpage.php");
							exit();
							break;
					}
				}
				else{
					continue;
				}
			}
//-----------------------------------------------------------------------------------------------------------------------
			//if it doesnt match, stay on webpage and display error
			if ($userverify == True & $passverify == False){
				header("Location:homelogin.php?error=incorrectpass");
			}
			//if nothing matches, stay on webpage and display error
			if($userverify == False & $passverify == False){
				header("Location:homelogin.php?error=invalidinputs");
			}
			else{
				continue;
			}
		}
	}
	else{
		echo "";
	}
	//closes connection
	mysqli_close($conn);
?>

<head>
	<title>
		Homelogin
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<style>
html *{
font-family: nunito, sans-serif;
}


body{
background-color:white;
margin: 0;
}


ul.topnav {
position:absolute;
margin: 0;
padding: 0;
overflow: hidden;
background-color: white;
width:100%;
right:0;
}

.background{
width:100%;
height:100%;
background-position: center;
background-size: cover;
background-image: url("bgimg.jpg");
background-attachment: fixed;
color:white;
display:flex;
justify-content:center;
align-items: center;
margin:0;
padding:0;
filter: blur(2px);
z-index: -1;
position: absolute;
}


.container{
margin: auto;
right: 0;
left: 0;
bottom: 0;
top: 0;
width: 405px;
height: 300px;
background-color: rgba(0,0,0,0.3);
position: absolute;
align-items: center;
}

button {
color: white;
padding: 16px 32px;
text-align: center;
display: inline-block;
font-size: 10px;
transition-duration: 1s;
cursor: pointer;
position: absolute;
left: 0;
width:30%;
height: 50px;
}

.container button{
color:black;
margin-top:230px;
}
#login {
margin-left: 140px;
}
button:hover{
color: white;
background-color:blue;
}
label{
position:absolute;
color:white;
}
input[type="text"]{
top: 50px;
position:absolute;
}
input[type="password"]{
top: 150px;
position:absolute;
}
#username_label{
top: 30px;
}
#password_label{
top: 130px;
}


form {
border: 3px solid black;
width: 400px;
height:300px;
left:0;
right:0;
bottom:0;
top:0;
margin:auto;
position: absolute;
}

input[type="text"], input[type="password"]{
width:100%;
position:absolute;
margin:10px 0;
padding:12px 20px;
display: inline-block;
box-sizing: border-box;
}

h1 {
color: red;
}
</style>




	<div class="background">
	</div>
	<div class="container">
		<form method="post">
		<label id="username_label">Username: </label>
		<input type="text" placeholder="Enter Username" name="username">
		<label id="password_label">Password: </label>
		<input type="password" placeholder="Enter Password" name="password">
		<button id="login" type="submit" value="lgin">Login</button>
		</form>
	</div>
</body>
