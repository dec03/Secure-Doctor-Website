<?php
	session_start();
	$servername = "localhost";
	$username = "";
	$password = "";
	$dbname = "";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error){
		die("Connection Failed: " . $conn->connect_error);
	}

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
//---------------------------------------------------------------------------------------------------------------------------------------------------
	//FOR THE CODE BELOW (description): each section will only run when the form it represents 
	//has been submitted, otherwise the count for the array of that form 
	//will return 0, so it will immediately break the FOR LOOP

	//updates patient table in database if changes are made
	//do for loop to go through each index for each array and update them to the database (Where patient ID = [index of pt_patientid[x]])
	$length = count($_POST['pt_patientid']);
	for($x=0; ;$x++){
		if($x == $length){
			break;
		}
		else{
			filter_var($_POST['pt_patientfn'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['pt_patientln'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['pt_patientaddress'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['pt_patientdob'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['pt_patientphone'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$sql = "UPDATE patient SET FirstName = '" . encryptstring($_POST['pt_patientfn'][$x],$key) . "', LastName = '" . encryptstring($_POST['pt_patientln'][$x],$key) . "', Address = '" . encryptstring($_POST['pt_patientaddress'][$x],$key) . "', DOB = '" . $_POST['pt_patientdob'][$x] . "', Telephone = '" . encryptstring($_POST['pt_patientphone'][$x],$key) . "' WHERE patientID = " . $_POST['pt_patientid'][$x] . " ";
			$conn->query($sql);
			continue;
		}
	}
	//updates doctor table in database if changes are made
	//do for loop to go through each index for each array and update them to the database (Where patient ID = [index of pt_patientid[x]])
	$length = count($_POST['dt_doctorid']);
	for($x=0; ;$x++){
		if($x == $length){
			break;
		}
		else{
			filter_var($_POST['dt_doctorfn'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['dt_doctorln'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$sql = "UPDATE doctor SET FirstName = '" . encryptstring($_POST['dt_doctorfn'][$x],$key) . "', LastName = '" . encryptstring($_POST['dt_doctorln'][$x],$key) . "' WHERE doctorID = " . $_POST['dt_doctorid'][$x] . " ";
			$conn->query($sql);
			continue;
		}
	}
	//updates users table in database if changes are made
	//do for loop to go through each index for each array and update them to the database (Where patient ID = [index of pt_patientid[x]])
	$length = count($_POST['ut_userid']);
	for($x=0; ;$x++){
		if($x == $length){
			break;
		}
		else{
			filter_var($_POST['ut_username'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['ut_password'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['ut_usertype'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$sql = "UPDATE users SET username = '" . encryptstring($_POST['ut_username'][$x],$key) . "', userpassword = '" . encryptstring($_POST['ut_password'][$x],$key) . "' WHERE userID = " . $_POST['ut_userid'][$x] . " ";
			$conn->query($sql);
			continue;
		}
	}
	//updates appointment table in database if changes are made
	//do for loop to go through each index for each array and update them to the database (Where patient ID = [index of pt_patientid[x]])
	$length = count($_POST['at_id']);
	for($x=0; ;$x++){
		if($x == $length){
			break;
		}
		else{
			filter_var($_POST['at_dfn'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['at_dln'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['at_pfn'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['at_pln'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['at_date'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['at_time'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			filter_var($_POST['at_notes'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$sql = "UPDATE appointment SET doctorfn = '" . encryptstring($_POST['at_dfn'][$x],$key) . "', doctorln = '" . encryptstring($_POST['at_dln'][$x],$key) . "', patientfn = '" . encryptstring($_POST['at_pfn'][$x],$key) . "', patientln = '" . encryptstring($_POST['at_pln'][$x],$key) . "', doctor_schedule_date = '" . $_POST['at_date'][$x] . "', doctor_schedule_starttime = '" . $_POST['at_time'][$x] . "', medicalnotes = '" . encryptstring($_POST['at_notes'][$x],$key) . "' WHERE appointmentID = " . $_POST['at_id'][$x] . " ";
			$conn->query($sql);
		}
	}

	$conn->close();
?>
<head>
	<title>
		adminpage
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
height: 1000vh;
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


ul.topnav li {
float: right;
list-style: none;
width:200px;
position: relative;
}
ul.topnav li a{
display: block;
text-align: center;
padding: 14px 16px;
text-decoration: none;
color:black;
transition:all 0.5s ease-in-out;
}
ul.topnav li a:hover{
background-color:blue;
color:white;
}


ul.topnav li ul li{
display:none;
background-color: rgba(255,255,255,0.7);
visibility:invisible;
overflow:hidden;
opacity: 0;
transform: translateY(-3em);
transition: all 0.5s ease-in-out 0s, visibility 0s linear 0.3s;
text-align: center;
z-index:-1;
}
@keyframes delay-pointer-events{
	0% {
	pointer-events: none;
	}
	100% {
	pointer-events: auto;
	}
}
ul.topnav li:hover ul li{
display: block;
animation: delay-pointer-events 1000ms linear;
top:100%;
left:0;
visibility: visible;
opacity: 1;
transform: translateY(0);
z-index: 1;
}


.background{
width:100%;
height:500px;
background-position: center;
background-size: cover;
background-image: url("adminbg.jpg");
background-attachment: fixed;
color:white;
display:flex;
justify-content:center;
align-items: center;
margin:0;
padding:0;
}

.navbar {
top: 0px;
position: absolute;
right: 0;
width:100%;
backdrop-filter:blur(20px);
}

.container {
width: 100%;
height: 100px;
text-align: center;
}
.container h1{
margin-top: 30px;
}

.content {
top: 600px;
position:absolute;
background-color:#DCDCDC;
width: 1200px;
overflow: hidden;
white-space: nowrap;
}



#title_table{
top: 515px;
position:absolute;
width: 100%;
color: black;
left:0;
right:0;
}

table{
table-layout: fixed;
border: 1px solid black;
margin: 0 auto;
width: 100%;
word-break: break-word;
}
table td{
font-size:14px;
text-align: center;
border: 1px solid black;
}
table th{
font-size:16px;
width:10%;
}
table tr{
}

#patientdb{
display: none;
}
#doctordb{
display: none;
}
#userdb{
display:none;
}
#appointmentdb{
display:none;
}


button{
background: none;
color: inherit;
border: none;
font: inherit;
cursor: inherit;
outline: inherit;
}
textarea{
min-width:120px;
max-width:120px;
max-height:80px;
min-height:80px;
resize: none;
}
#save1{
display: none;
text-align: center;
padding: 14px 16px;
text-decoration: none;
color:black;
transition:all 0.5s ease-in-out;
border: 1px solid black;
}
#save1:hover{
background-color:blue;
color:white;
border: 1px solid black;
}
#save2{
display: none;
text-align: center;
padding: 14px 16px;
text-decoration: none;
color:black;
transition:all 0.5s ease-in-out;
border: 1px solid black;
}
#save2:hover{
background-color:blue;
color:white;
border: 1px solid black;
}
#save3{
display: none;
text-align: center;
padding: 14px 16px;
text-decoration: none;
color:black;
transition:all 0.5s ease-in-out;
border: 1px solid black;
}
#save3:hover{
background-color:blue;
color:white;
border: 1px solid black;
}
#save4{
display: none;
text-align: center;
padding: 14px 16px;
text-decoration: none;
color:black;
transition:all 0.5s ease-in-out;
border: 1px solid black;
}
#save4:hover{
background-color:blue;
color:white;
border: 1px solid black;
}
</style>
	<div class="background">
		<div class="navbar">
			<ul class="topnav">
				<li><button onclick="showhidedoctor()"><a href="#">Doctor Info</a></button>
				<li><button onclick="showhidepatient()"><a>Patient Info</a></button>
				<li><button onclick="showhideappointments()"><a href="#">Appointments</a></button>
				<li><button onclick="showhideuser()"><a href="#">User Accounts</a></button>
			</ul>
		</div>
		<div class="container">
			<h1>Admin Page</h1>
			<?php
			echo "<h1 id='title_table'></h1>";
			?>
		</div>


		<div class="content">
			<?php
			$servername = "localhost";
			$username = "M00842543Danie";
			$password = "I-play-pian0";
			$dbname = "M00842543Danie";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if($conn->connect_error){
				die("Connection Failed: " . $conn->connect_error);
			}


			//RETREIVE TABLES
			//patient table
			$sql = "SELECT * FROM patient ORDER BY LastName";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				echo "<form method='post'><table id='patientdb'><tr><th>Patient ID</th><th>First Name</th><th>Last Name</th><th>Address</th><th>DOB</th><th>Telephone Number</th><th>User ID</th>";
				while($row = $result->fetch_assoc()){
					echo "<tr><td><textarea name='pt_patientid[]' readonly>" . $row["patientID"]. "</textarea></td><td><textarea name='pt_patientfn[]'>" . decryptstring($row['FirstName'],$key) . "</textarea></td><td><textarea name='pt_patientln[]'>" . decryptstring($row['LastName'],$key) . "</textarea></td><td><textarea name='pt_patientaddress[]'>" . decryptstring($row['Address'],$key) . "</textarea></td><td><textarea name='pt_patientdob[]'>" . $row['DOB'] . "</textarea></td><td><textarea name='pt_patientphone[]'>" . decryptstring($row['Telephone'],$key) . "</textarea></td><td>" . $row['userID'] . "</td></tr>";
				}
				echo "<button id='save1' type='submit'>Save Changes</button></form></table>";
			}
			else{
				echo "No result";
			}
			//doctor table
			$sql = "SELECT * FROM doctor ORDER BY LastName";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				echo "<form method='post'><table id='doctordb'><tr><th>Doctor ID</th><th>First Name</th><th>Last Name</th><th>User ID</th>";
				while($row = $result->fetch_assoc()){
					echo "<tr><td><textarea name='dt_doctorid[]' readonly>" . $row["doctorID"]. "</textarea></td><td><textarea name='dt_doctorfn[]'>" . decryptstring($row['FirstName'],$key) . "</textarea></td><td><textarea name='dt_doctorln[]'>" . decryptstring($row['LastName'],$key) . "</textarea></td><td>" . $row['userID'] . "</td></tr>";
				}
				echo "<button id='save2' type='submit'>Save Changes</button></form></table>";
			}
			else{
				echo "No result";
			}
			//user table
			$sql = "SELECT * FROM users ORDER BY user_type";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				echo "<form method='post'><table id='userdb'><tr><th>User ID</th><th>Username</th><th>Password</th><th>User Type</th>";
				while($row = $result->fetch_assoc()){
					echo "<tr><td><textarea readonly name='ut_userid[]'>" . $row["userID"]. "</textarea></td><td><textarea name='ut_username[]'>" . decryptstring($row['username'],$key) . "</textarea></td><td><textarea name='ut_password[]'>" . decryptstring($row['userpassword'],$key) . "</textarea></td><td><textarea name='ut_usertype[]'>" . $row['user_type'] . "</textarea></td></tr>";
				}
				echo "<button id='save3' type='submit'>Save Changes</button></form></table>";
			}
			else{
				echo "No result";
			}
			//appointment table
			$sql = "SELECT * FROM appointment ORDER BY appointmentid";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				echo "<form method='post'><table id='appointmentdb'><tr><th>Appointment ID</th><th>Doctor FirstName</th><th>Doctor Lastname</th><th>Patient FirstName</th><th>Patient LastName</th><th>Date</th><th>Time</th><th>Medical Notes</th>";
				while($row = $result->fetch_assoc()){
					echo "<tr><td><textarea readonly name='at_id[]'>" . $row["appointmentID"]. "</textarea></td><td><textarea name='at_dfn[]'>" . decryptstring($row['doctorfn'],$key) . "</textarea></td><td><textarea name='at_dln[]'>" . decryptstring($row['doctorln'],$key) . "</textarea></td><td><textarea name='at_pfn[]'>" . decryptstring($row['patientfn'],$key) . "</textarea></td><td><textarea name='at_pln[]'>" . decryptstring($row['patientln'],$key) . "</textarea></td><td><textarea name='at_date[]'>" . $row['doctor_schedule_date'] . "</textarea></td><td><textarea name='at_time[]'>" . $row['doctor_schedule_starttime'] . "</textarea></td><td><textarea name='at_notes[]' readonly>" . decryptstring($row['medicalnotes'],$key) . "</textarea></td></tr>";
				}
				echo "<button id='save4' type='submit'>Save Changes</button></form></table>";
			}
			else{
				echo "No result";
			}
			$conn->close();
			?>
		</div>
	</div>


<script type="text/javascript">
//shows or hides patient table
function showhidepatient() {
	if(document.getElementById('patientdb').style.display == 'none'){
		//hides other tables
		document.getElementById('doctordb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
		document.getElementById('save2').style.display = 'none';	
		document.getElementById('save3').style.display = 'none';	
		document.getElementById('userdb').style.display = 'none';
		document.getElementById('appointmentdb').style.display = 'none';
		document.getElementById('save4').style.display = 'none';
		
		//displays patient table
		document.getElementById('patientdb').style.display = 'block';
		document.getElementById('title_table').innerHTML = 'Patient Table';
		document.getElementById('save1').style.display = 'block';
	}
	else{
		document.getElementById('patientdb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
		document.getElementById('save1').style.display = 'none';
	}
}


//shows or hides doctor table
function showhidedoctor() {
	if(document.getElementById('doctordb').style.display == 'none'){
		//hides other tables
		document.getElementById('patientdb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
		document.getElementById('save1').style.display = 'none';
		document.getElementById('save3').style.display = 'none';	
		document.getElementById('userdb').style.display = 'none';
		document.getElementById('appointmentdb').style.display = 'none';
		document.getElementById('save4').style.display = 'none';

		//displays doctor table
		document.getElementById('doctordb').style.display = 'block';
		document.getElementById('title_table').innerHTML = 'Doctor Table';
		document.getElementById('save2').style.display = 'block';	
	}
	else{
		document.getElementById('doctordb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
		document.getElementById('save2').style.display = 'none';	
	}
}

//shows or hides user table
function showhideuser() {
	if(document.getElementById('userdb').style.display == 'none'){
		//hides other tables
		document.getElementById('patientdb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
		document.getElementById('save1').style.display = 'none';
		document.getElementById('save2').style.display = 'none';		
		document.getElementById('doctordb').style.display = 'none';
		document.getElementById('appointmentdb').style.display = 'none';
		document.getElementById('save4').style.display = 'none';
		//displays patient table
		document.getElementById('userdb').style.display = 'block';
		document.getElementById('title_table').innerHTML = 'Users Table';
		document.getElementById('save3').style.display = 'block';	
	}
	else{
		document.getElementById('userdb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
		document.getElementById('save3').style.display = 'none';
	}
}

function showhideappointments() {
	if(document.getElementById('appointmentdb').style.display == 'none'){
		//hides other tables
		document.getElementById('doctordb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
		document.getElementById('save2').style.display = 'none';	
		document.getElementById('save3').style.display = 'none';
		document.getElementById('save1').style.display = 'none';	
		document.getElementById('userdb').style.display = 'none';
		document.getElementById('patientdb').style.display = 'none';
		//displays patient table
		document.getElementById('appointmentdb').style.display = 'block';
		document.getElementById('title_table').innerHTML = 'Appointment Table';
		document.getElementById('save4').style.display = 'block';	
	}
	else{
		document.getElementById('appointmentdb').style.display = 'none';
		document.getElementById('title_table').innerHTML = '';
		document.getElementById('save4').style.display = 'none';	
	}
}
</script>
</body>
