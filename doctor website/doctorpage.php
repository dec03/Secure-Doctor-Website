<?php
	session_start();
	$servername = "localhost";
	$username = "M00842543Danie";
	$password = "I-play-pian0";
	$dbname = "M00842543Danie";
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
//-------------------------------------------------------------------------------------------------------------
	//gets doctor ID 
	$sql = "SELECT doctorID FROM doctor WHERE userID = " . $_SESSION['userID'] . " ";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$doctorID = $row['doctorID'];
	}
//-------------------------------------------------------------------------------------------------------------
	//updates appointment table in database if changes are made to medical notes
	//do for loop to go through each index for each array and update them to the database (Where patient ID = [index of pt_patientid[x]])
	$length = count($_POST['at_id']);
	for($x=0; ;$x++){
		if($x == $length){
			break;
		}
		else{
			echo $_POST['at_notes'][$x];
			$_POST['at_notes'][$x] = filter_var($_POST['at_notes'][$x], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			echo $_POST['at_notes'][$x];
			$sql = "UPDATE appointment SET medicalnotes = '" . encryptstring($_POST['at_notes'][$x],$key) . "' WHERE appointmentID = " . $_POST['at_id'][$x] . " ";
			$conn->query($sql);
			continue;
		}
	}
	$conn->close();
?>

<head>
	<title>
		doctorpage
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

.background{
width:100%;
height:500px;
background-position: center;
background-size: cover;
background-image: url("doctorbg.jpg");
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
backdrop-filter: blur(2px);
width: 100%;
height: 100px;
text-align: center;
}
.container h1{
margin-top:30px;
}

.content {
top: 600px;
position:absolute;
background-color:#DCDCDC;
width: 1100px;
overflow: hidden;
white-space: nowrap;
}

button{
background: none;
color: inherit;
border: none;
font: inherit;
cursor: inherit;
outline: inherit;
}

#title_table{
top: 300px;
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
}
table tr{
}
#medicinename{
width:100px;
}
#medicineid{
width: 100px;
}
#medicinedb {
display: none;
}
#appointmentdb{
display:none;
}
#medicalnotesdb{
display:none;
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
textarea{
min-width:180px;
max-width:180px;
max-height:80px;
min-height:80px;
resize: none;
}
</style>
	<div class="background">
		<div class="navbar">
			<ul class="topnav">	
				<li><button onclick="showhideappointments()"><a href="#">Appointments</a></button>
				<li><button onclick="showhidenotes()"><a href="#">Medical Notes</a></button>
				<li><button onclick="showhidemedicine()"><a href="#">Medicines</a></button>
			</ul>
		</div>
		<div class="container">
		<h1>Doctor Page</h1>
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
			//medicine table
			$sql = "SELECT * FROM medicine ORDER BY MedicineName";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				echo "<table id='medicinedb'><tr><th id='medicineid'>Medicine ID</th><th id='medicinename'>Medicine</th><th>Description</th>";
				while($row = $result->fetch_assoc()){
					echo "<tr><td>" . $row["medicineID"]. "</td><td>" . $row['MedicineName'] . "</td><td>" . $row['Description'] . "</td></tr>";
				}
				echo "</table>";
			}
			else{
				echo "No result";
			}
			//medical notes table
			$sql = "SELECT * FROM appointment WHERE doctorID = " . $doctorID . " ORDER BY appointmentid";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				echo "<form method='post'><table id='medicalnotesdb'><tr><th>Appointment ID</th><th>Doctor FirstName</th><th>Doctor Lastname</th><th>Patient FirstName</th><th>Patient LastName</th><th>Date</th><th>Time</th><th>Medical Notes</th>";
				while($row = $result->fetch_assoc()){
					echo "<tr><td><textarea readonly name='at_id[]'>" . $row["appointmentID"]. "</textarea></td><td>" . decryptstring($row['doctorfn'],$key) . "</td><td>" . decryptstring($row['doctorln'],$key) . "</td><td>" . decryptstring($row['patientfn'],$key) . "</td><td>" . decryptstring($row['patientln'],$key) . "</td><td>" . $row['doctor_schedule_date'] . "</td><td>" . $row['doctor_schedule_starttime'] . "</td><td><textarea name='at_notes[]'>" . decryptstring($row['medicalnotes'],$key) . "</textarea></td></tr>";
				}
				echo "<button id='save4' type='submit'>Save Changes</button></form></table>";
			}
			else{
				echo "No result";
			}
			
			//appointment table
			$sql = "SELECT * FROM appointment WHERE doctorID = " . $doctorID . " ORDER BY doctor_schedule_date, doctor_schedule_starttime";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				echo "<table id='appointmentdb'><tr><th>Appointment ID</th><th>Doctor FirstName</th><th>Doctor Lastname</th><th>Patient FirstName</th><th>Patient LastName</th><th>Date</th><th>Time</th>";
				while($row = $result->fetch_assoc()){
					echo "<tr><td>" . $row["appointmentID"]. "</td><td>" . decryptstring($row['doctorfn'],$key) . "</td><td>" . decryptstring($row['doctorln'],$key) . "</td><td>" . decryptstring($row['patientfn'],$key) . "</td><td>" . decryptstring($row['patientln'],$key) . "</td><td>" . $row['doctor_schedule_date'] . "</td><td>" . $row['doctor_schedule_starttime'] . "</td></tr>";
				}
				echo "</table>";
			}
			else{
				echo "No result";
			}
			
			$conn->close();
			?>
		</div>
	</div>


<script type="text/javascript">
//shows or hides medicine table
function showhidemedicine() {
	if(document.getElementById('medicinedb').style.display == 'none'){
		//hides other tables
		document.getElementById('appointmentdb').style.display = 'none';
		document.getElementById('medicalnotesdb').style.display = 'none';
		document.getElementById('save4').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";	
		//displays medicine table
		document.getElementById('medicinedb').style.display = 'block';
		document.getElementById('title_table').innerHTML = 'Medicine Table';
	}
	else{
		document.getElementById('medicinedb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
		
	}
}
//show or hides appointment table with notes
function showhidenotes() {
	if(document.getElementById('medicalnotesdb').style.display == 'none'){
		//hides other tables
		document.getElementById('medicinedb').style.display = 'none';
		document.getElementById('appointmentdb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";	
		//displays patient table
		document.getElementById('medicalnotesdb').style.display = 'block';
		document.getElementById('title_table').innerHTML = 'Medical Notes';
		document.getElementById('save4').style.display = 'block';
	}
	else{
		document.getElementById('medicalnotesdb').style.display = 'none';
		document.getElementById('title_table').innerHTML = '';
		document.getElementById('save4').style.display = 'none';	
	}
}
//show or hides appointment table with medical notes
function showhideappointments() {
	if(document.getElementById('appointmentdb').style.display == 'none'){
		//hides other tables
		document.getElementById('medicinedb').style.display = 'none';
		document.getElementById('medicalnotesdb').style.display = 'none';
		document.getElementById('save4').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";	
		//displays patient table
		document.getElementById('appointmentdb').style.display = 'block';
		document.getElementById('title_table').innerHTML = 'Appointment Table';
	}
	else{
		document.getElementById('appointmentdb').style.display = 'none';
		document.getElementById('title_table').innerHTML = '';
	}
}
</script>

</body>