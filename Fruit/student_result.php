<?php
// Start the session
session_start();
?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbName="resultdb";

        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbName);

        // Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else echo "Connected successfully <br>";
//start fetching info
date_default_timezone_set('Asia/Dhaka');
$board_name=$_SESSION["board"];
$year=$_SESSION["year"];
$roll=$_SESSION["roll"];
$sql="SELECT student_personal_info.student_name,student_personal_info.father_name,student_personal_info.mother_name,student_personal_info.date_of_birth,student_academic_info.roll,student_academic_info.registration,student_academic_info.group,student_academic_info.type FROM student_academic_info join student_personal_info on student_academic_info.roll= student_personal_info.roll where student_academic_info.roll='$roll'";
$result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 $sql_name=$row["student_name"];$sql_fname=$row["father_name"];$sql_mname=$row["mother_name"];$sql_date=$row["date_of_birth"];$sql_roll=$row["roll"];$sql_registration=$row["registration"];$sql_group=$row["group"];$sql_type=$row["type"];
$sql_date = date("d-m-Y", strtotime($sql_date));
//fetch cgpa
$sql="SELECT result_info.cgpa FROM result_info where result_info.student_roll='$roll'";
$result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 $sql_cgpa=$row["cgpa"];
 $sql_cgpa = number_format($sql_cgpa, 2, '.', '');
 echo $sql_cgpa;
//
$sql="SELECT subject_wise_result.subject_name,subject_wise_result.subject_code,subject_wise_result.subject_gpa FROM subject_wise_result where subject_wise_result.student_roll ='$roll'";
$result = mysqli_query($conn, $sql); 
/*while($row = mysqli_fetch_assoc($result)){
  echo $row["subject_name"]." ".$row["subject_code"]." ".$row["subject_gpa"]."<br/>";
}*/


?>
<!DOCTYPE html>
<html>
<head>
	<title>FRUIT</title>
	<link rel="stylesheet" type="text/css" href="style.css">
 	<meta charset='utf-8'/>
 	<meta name='viewport' content ='width=device-width,initial=scale=1'/> 
</head>
<body>
    <div class="container">
    	<div id="head">
    		<a href="menu.php"><img src="pic/board.png"></a>
    	</div>
    	<div>
            <table style="width:100%">
                 <tr>
                      <td><b>Name: </b></td>
                     <td><?php echo $sql_name; ?></td> 
                     <td><b>Roll: </b></td>
                    <td><?php echo $sql_roll; ?></td>
                </tr>
                <tr>
                      <td><b>Father's Name: </b></td>
                     <td><?php echo $sql_fname; ?></td> 
                     <td><b>Registration: </b></td>
                    <td><?php echo $sql_registration; ?></td>
                </tr>
                <tr>
                      <td><b>Mother's Name: </b></td>
                     <td><?php echo $sql_mname; ?></td> 
                     <td><b>Group: </b></td>
                    <td><?php echo $sql_group; ?></td>
                </tr>
                <tr>
                      <td><b>Date of birth: </b></td>
                     <td><?php echo $sql_date; ?></td>
                     <td><b>Type: </b></td>
                    <td><?php echo $sql_type; ?></td> 
                </tr>
                <tr>
                      <td><b>CGPA: </b></td>
                     <td><?php echo $sql_cgpa; ?></td> 
                </tr>
            </table>
        </div>
        <div>
          <p><b>Subject Wise Result</b></p>
        </div>
        <div style= "background-color: grey; color: black; width:80%; margin: 0 auto;">
          <table style= "background-color: grey; color: black; width:80%;" >
            <thead>
              <tr style= "text-align:left;">
                <th>Subject Name</th>
                <th>Code</th>
                <th>GPA</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                  while($row = mysqli_fetch_assoc($result)){
                    echo "<tr><td>{$row["subject_name"]}</td><td>{$row["subject_code"]}</td><td>{$row["subject_gpa"]}</td></tr>\n";
                  }
                  //mysqli_close($conn);
               ?>
          </tbody>
          </table>
        </div>
    	<div id="footer">
    		<p>Contact information: <a href="someone@example.com">
               someone@example.com</a>.
            </p>
    	</div>
    </div>
</body>
</html>