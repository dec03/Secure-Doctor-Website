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
	//getting PATIENT INFO
	//gets patient ID 
	$sql = "SELECT patientID FROM patient WHERE userID = " . $_SESSION['userID'] . " ";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$patientID = $row['patientID'];
	}
	//gets patient fn and ln
	$sql = "SELECT * FROM patient WHERE userID = " . $_SESSION['userID'] . " ";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$patientfn = $row['FirstName'];
		$patientln = $row['LastName'];
	}
//---------------------------------------------------------------------------------------------------------------------------------
	//get info from form
	$doctorfn = ucfirst($_POST['doctorfn']);
	$doctorln = ucfirst($_POST['doctorln']);
	$ap_date = $_POST['ap_date'];
	$ap_time = $_POST['ap_time'];
	$medical_notes = $_POST['medical_notes'];
//------------------------------------------------------------------------------
	//gets all available dates in schedule table
	$sql = "SELECT * FROM doctor_schedule_table";
	$result = $conn->query($sql);
	$dates_available = array();
	while($row = $result->fetch_assoc()){
		array_push($dates_available, $row['doctor_schedule_date']);
	}
	//for loop to get min date
	$min_date = $dates_available[0];
	foreach($dates_available as $value){
		if($value < $min_date){
			$min_date = $value;
		}
		else{
			continue;
		}
	}
	//for loop to get max date
	$max_date = $dates_available[0];
	foreach($dates_available as $value){
		if($value > $max_date){
			$max_date = $value;
		}
		else{
			continue;
		}
	}


//---------------------------------------------------------------------------------------------------------------------------
	//when submit button is pressed, if the all fields required are filled (medical_notes at first is optional when booking)
	if(isset($doctorfn,$doctorln,$ap_date,$ap_time)){
		//SANITIZATION to prevent sql injection
		$doctorfn = filter_var($doctorfn, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$doctorln = filter_var($doctorfn, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$medical_notes = filter_var($medical_notes, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		
		//sql to get doctorID
		$sql = "SELECT * FROM doctor";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			//if both initials match from names in form, get doctor ID
			if(decryptstring($row['FirstName'],$key) == $_POST['doctorfn']){
				if(decryptstring($row['LastName'],$key) == $_POST['doctorln']){
					$doctorID = $row['doctorID'];
					break;
				}
				else{
					continue;
				}
			}
			else{
				continue;
			}
		}
		//SQL to retrieve data
		$sql = "SELECT * FROM doctor_schedule_table";
		$result = $conn->query($sql);
		//WHILE LOOP to go through each row
		while($row = $result->fetch_assoc()){
			$doctorln = $_POST['doctorln'];
			//checks for first name of doctor
			$doctor_fn_db = decryptstring($row['FirstName'],$key);
			$doctor_ln_db = decryptstring($row['LastName'],$key);
			//verifies doctor 
			$doctorverify = False;
			if($doctor_fn_db == $doctorfn){
				if($doctor_ln_db == $doctorln){
					$doctorverify = True;
					break;
				}
				else{
					continue;
				}
			}
			else{
				continue;
			}
		}
		$sql = "SELECT * FROM doctor_schedule_table";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			//verifies time available
			$appointment_found = False;
			if($ap_date == $row['doctor_schedule_date']){
				if($ap_time == $row['doctor_schedule_starttime']){
					if($row['doctor_schedule_status'] == 'Active'){				
						if($row['doctorID'] == $doctorID){
							$appointment_found = True;
							$scheduleID = $row['doctorscheduleID'];
							break;
						}
						else{
							continue;
						}
					}
					else{
						continue;
					}
				}
				else{
					continue;
				}
			}
			else{
				continue;
			}
		}
		//switch case
		//case 1 - if doctor name is verified, check if appointment is available.
		//case 1.1 - if appointment available, do sql qeury and alert user that it is booked
		//case 1.2 - if appointment not available, alert user it is not available
		//case 2 - if is not verified, display error of invalid input or apoointment not available
		switch ($doctorverify) {
			case True:
				switch ($appointment_found){
					case True:
						//sql to get encrypted doctor fn and ln
						$sql = "SELECT * FROM doctor";
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()){
							//if both initials match from names in form
							if(decryptstring($row['FirstName'],$key) == $_POST['doctorfn']){
								if(decryptstring($row['LastName'],$key) == $doctorln){
									$doctorfn = $row['FirstName'];
									$doctorln = $row['LastName'];
									break;
								}
								else{
									continue;
								}
							}
							else{
								continue;
							}
						}					
						//Insert into appointment and book
						$sql = "INSERT INTO appointment (doctorID, doctorfn, doctorln, patientID, patientfn, patientln,doctorscheduleID,doctor_schedule_date, doctor_schedule_starttime,medicalnotes) VALUES (" . $doctorID . ", '" . $doctorfn . "', '" . $doctorln . "', " . $patientID . ", '" . $patientfn . "', '" . $patientln . "', " . $scheduleID . ", '" . $ap_date . "', '" . $ap_time . "', '" . encryptstring($medical_notes,$key) . "' );";
						$conn->query($sql);
						//Update doctors schedule to say that appointment is now inactive and occupied
						$sql = "UPDATE doctor_schedule_table SET doctor_schedule_status = 'Inactive' WHERE doctorscheduleID = " . $scheduleID . " ";
						$conn->query($sql);

						echo "<script type='text/JavaScript'>alert('Booked Appointment for: " . $ap_date . " " . $ap_time . "')</script>";
						break;
					case False:
						//output appointment not available
						echo "<script type='text/JavaScript'>alert('Appointment Not Available')</script>";
						break;
				}
				break;
			case False:
				//output doctor not found
				echo "<script type='text/JavaScript'>alert('Doctor Not Found')</script>";
				break;
		}
	}
	$conn->close();
?>
<head>
	<title>
		patientpage
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
background-image: url("patientbg.jpg");
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
margin-top: 30px;
}
.content {
top: 900px;
position:absolute;
background-color:#DCDCDC;
width: 1000px;
overflow: hidden;
white-space: nowrap;
}
.test{
position:absolute;
top:50px;
width: 500px;
height: 500px;
background-color: gray;
}
li button{
background: none;
color: inherit;
border: none;
font: inherit;
cursor: inherit;
outline: inherit;
}
#title_table{
top: 600px;
position:absolute;
width: 100%;
color: black;
left:0px;
right:0px;
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
#appointmentdb{
display: none;
}
#form_ap{
top: 600px;
position:absolute;
background-color:#DCDCDC;
width: 700px;
overflow: hidden;
white-space: nowrap;
height: 200px;
display:none;
}
#fn{
display:inline-block;
position: absolute;
top:30px;
width:30%;
}
#ln{
position:absolute;
display: inline-block;
top:70px;
width:30%;
}
#date{
position:absolute;
display: inline-block;
top: 110px;
width:30%;
}
#time{
position:absolute;
display: inline-block;
top:150px;
width:30%;
}
#explain{
position:absolute;
display: inline-block;
top:180px;
width:30%;
font-size:10px;
left:10px;	
color:black;
}
#medicalnotes{
position: absolute;
top: 30px;
min-width: 310px;
max-width:310px;
min-height: 144px;
max-height: 144px;
left:225px;
}
form button:hover{
color: white;
background-color:blue;
}
form button {
color: black;
padding: 16px 32px;
text-align: center;
display: inline-block;
font-size: 10px;
transition-duration: 1.5s;
cursor: pointer;
position: absolute;
right: 10px;
top: 80px;
width:20%;
height: 50px;
}
#display_outcome1{
position: absolute;
top: 520px;
left:100px;
right:100px;
text-align:center;
display:none;
}
#display_outcome2{
position: absolute;
top: 520px;
left:100px;
right:100px;
text-align:center;
display:none;
}
#display_outcome3{
position: absolute;
top: 520px;
left:100px;
right:100px;
text-align:center;
display:none;
}
#recorddb{
display:none;
}
</style>
	<div class="background">
		<div class="navbar">
			<ul class="topnav">
				<li><button onclick="showhiderecord()"><a href="#">Medical Record</a></button>
				<li><button onclick="showhideappointments()"><a href="#">Book Appointment</a></button>
			</ul>
		</div>
		<div class="container">
			<h1>Patient Page</h1>
			<?php
			echo "<h1 id='title_table'></h1>";
			?>
		</div>
	




		<div id='form_ap'>
			<form id='apf' method='post'>
				<select name='doctorfn' type='text' id='fn' placeholder='Enter Doctor First Name'>
					<?php
						$servername = "localhost";
						$username = "M00842543Danie";
						$password = "I-play-pian0";
						$dbname = "M00842543Danie";
						$conn = new mysqli($servername, $username, $password, $dbname);
						if($conn->connect_error){
							die("Connection Failed: " . $conn->connect_error);
						}
						$sql = "SELECT FirstName FROM doctor";
						$result = $conn->query($sql);
						$dfn = array();
						while($row=$result->fetch_assoc()){
							array_push($dfn,decryptstring($row['FirstName'],$key));
						}
						for($x=0; ;$x++){
							if($x == count($dfn)){
								break;
							}
							else{
								echo "<option value='" . $dfn[$x] . "'>" . $dfn[$x] . "</option>";
							}
						}
						$conn->close()
					?>
				</select>
				<select name='doctorln' type='text' id='ln' placeholder='Enter Doctor Last Name'>
					<?php
						$servername = "localhost";
						$username = "M00842543Danie";
						$password = "I-play-pian0";
						$dbname = "M00842543Danie";
						$conn = new mysqli($servername, $username, $password, $dbname);
						if($conn->connect_error){
							die("Connection Failed: " . $conn->connect_error);
						}
						$sql = "SELECT LastName FROM doctor";
						$result = $conn->query($sql);
						$dln = array();
						while($row=$result->fetch_assoc()){
							array_push($dln,decryptstring($row['LastName'],$key));
						}
						for($x=0; ;$x++){
							if($x == count($dln)){
								break;
							}
							else{
								echo "<option value='" . $dln[$x] . "'>" . $dln[$x] . "</option>";
							}
						}
						$conn->close()
					?>
				</select>
				<input name='ap_date' <?php echo "min='" . $min_date . "' "?> <?php echo "max='" . $max_date . "' "?> type='date' id='date' placeholder='Enter Date'>
				<input name='ap_time' type='time' id='time' value='00:00'>
				<label id='explain'>Must be on the hour (01:00, 02:00, etc)</label>
				<textarea name='medical_notes' id='medicalnotes' form='apf' placeholder='What are you booking an appointment for?'></textarea>
				<button id='book' type='submit'>Book</button>
			</form>
		</div>
	
		<div>
		</div>
		<div class="content">
		<?php
//-----------------------------------------------------------------------------------------------------------------
			$servername = "localhost";
			$username = "M00842543Danie";
			$password = "I-play-pian0";
			$dbname = "M00842543Danie";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if($conn->connect_error){
				die("Connection Failed: " . $conn->connect_error);
			}
//----------------------------------------------------------------------------------------------------------------------
			//RETREIVE TABLES
			//appointment table
			$sql = "SELECT * FROM doctor_schedule_table ORDER BY LastName, doctor_schedule_date, doctor_schedule_starttime";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				echo "<table id='appointmentdb'><tr><th>Doctor First Name</th><th>Doctor Last Name</th><th>Date</th><th>Day</th><th>Time</th>";
				while($row = $result->fetch_assoc()){
					if($row['doctor_schedule_status'] == 'Inactive'){
						continue;
					}
					else{
						echo "<tr><td>" . decryptstring($row["FirstName"],$key). "</td><td>" . decryptstring($row['LastName'],$key) . "</td><td>" . $row['doctor_schedule_date'] . "</td><td>" . $row['doctor_schedule_day'] . "</td><td>" . $row['doctor_schedule_starttime'] . "</td><tr>";
					}
				}
				echo "</table>";
			}
			else{
				echo "No result";
			}

			//medical record table for patient
			$sql = "SELECT * FROM appointment WHERE patientID = " . $patientID . " ";
			$result = $conn->query($sql);


			
			if($result->num_rows > 0){
				echo "<table id='recorddb'><tr><th>Doctor First Name</th><th>Doctor Last Name</th><th>Patient First Name</th><th>Patient Last Name</th><th>Date</th><th>Time</th><th>Medical Record</th>";
				while($row = $result->fetch_assoc()){
					if($row['doctor_schedule_status'] == 'Inactive'){
						continue;
					}
					else{
						echo "<tr><td>" . decryptstring($row["doctorfn"],$key). "</td><td>" . decryptstring($row['doctorln'],$key) . "</td><td>" . decryptstring($row["patientfn"],$key). "</td><td>" . decryptstring($row["patientln"],$key). "</td><td>" . $row['doctor_schedule_date'] . "</td><td>" . $row['doctor_schedule_starttime'] . "</td><td>" . decryptstring($row["medicalnotes"],$key). "</td><tr>";
					}
				}
				echo "</table>";
			}
			else{
				echo "<table id='recorddb'><tr><th>No Result</th></table>";
			}
			$conn->close();
//-------------------------------------------------------------------------------------------------------	
			?>
		</div>
	</div>
<script type="text/javascript">
//shows or hides appointments available table
function showhideappointments() {
	if(document.getElementById('appointmentdb').style.display == 'none'){
		//hides other tables
		document.getElementById('recorddb').style.display = 'none';
		//displays doctor schedules
		document.getElementById('appointmentdb').style.display = 'block';
		document.getElementById('title_table').innerHTML = 'Appointments';
		document.getElementById('form_ap').style.display = 'block';
	}
	else{
		document.getElementById('appointmentdb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
		document.getElementById('form_ap').style.display = 'none';
	}
}

function showhiderecord() {
	if(document.getElementById('recorddb').style.display == 'none'){
		//hides other tables
		document.getElementById('appointmentdb').style.display = 'none';
		document.getElementById('form_ap').style.display = 'none';
		//displays doctor schedules
		document.getElementById('recorddb').style.display = 'block';
		document.getElementById('title_table').innerHTML = 'Medical Record';
	}
	else{
		document.getElementById('recorddb').style.display = 'none';
		document.getElementById('title_table').innerHTML = " ";
	}
}
</script>
</body>