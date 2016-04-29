<?php
// Start the session
session_start();
?>
<?php
if(!$_SESSION["code"]){
    header("Location: logout.php");
    exit();
}
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

//mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>FRUIT</title>
	<link rel="stylesheet" type="text/css" href="style.css">
 	<meta charset='utf-8'/>
 	<meta name='viewport' content ='width=device-width,initial=scale=1'/> 
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    	<div id="head">
            <a href="menu.php"><h2>Secondary School Certificate Examination Result</h2></a>
        </div>
        <div id="one">
            <button onclick="window.location.href='logout.php'">
                <p>Log out</p>
            </button>
        </div>
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all" data-toggle="tab">All</a></li>
          <li><a href="#science" data-toggle="tab">Science</a></li>
          <li><a href="#commerce" data-toggle="tab">Commerce</a></li>
          <li><a href="#arts" data-toggle="tab">Arts</a></li>
      </ul>
      <div class="tab-content">
          <div class="tab-pane active" id="all">
              <table style= "background-color: grey; color: black; width:80%;" >
                <thead>
                  <tr style= "text-align:left;">
                    <th>Year</th>
                    <th>Group</th>
                    <th>Roll</th>
                    <th>CGPA</th>
                </tr>
            </thead>
            <tbody>
              <?php 
              $code=$_SESSION["code"];
              $sql="SELECT result_info.year,student_academic_info.group,result_info.student_roll,result_info.cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll where student_academic_info.institute_code='$code'";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                echo "<tr><td>{$row["year"]}</td><td>{$row["group"]}</td><td>{$row["student_roll"]}</td><td>{$row["cgpa"]}</td></tr>\n";
            }
            $sql="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $all=$row["all_cgpa"];
            $sql="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code' and result_info.cgpa>0";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $passed=$row["passed_cgpa"];
            
            if($all==0){
                $passrate=0;
                $failrate=0;
            }
            else{
                $passrate=$passed*100/$all;
                $failrate=100-$passrate;
            }
            if(is_float($passrate)){
                $passrate = number_format($passrate, 2, '.', '');
                $failrate = number_format($failrate, 2, '.', '');
            }                  // mysqli_close($conn);
            ?>
        </tbody>
         </table>
         <div>  <br/></div>
        <div>  Percentage of passing: <?php echo $passrate; ?>%</div>
        <div>  Percentage of failing: <?php echo $failrate; ?>%</div>
          </div>
          <div class="tab-pane" id="science">
              <table style= "background-color: grey; color: black; width:80%;" >
                <thead>
                  <tr style= "text-align:left;">
                    <th>Year</th>
                    <th>Group</th>
                    <th>Roll</th>
                    <th>CGPA</th>
                </tr>
            </thead>
            <tbody>
              <?php 
              $code=$_SESSION["code"];
              $sql="SELECT result_info.year,student_academic_info.group,result_info.student_roll,result_info.cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll where student_academic_info.institute_code='$code' and student_academic_info.group='Science'";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                echo "<tr><td>{$row["year"]}</td><td>{$row["group"]}</td><td>{$row["student_roll"]}</td><td>{$row["cgpa"]}</td></tr>\n";
            }
            $sql="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code' and student_academic_info.group='Science'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $all=$row["all_cgpa"];
            $sql="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code' and student_academic_info.group='Science' and result_info.cgpa>0";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $passed=$row["passed_cgpa"];
            if($all==0){
                $passrate=0;
                $failrate=0;
            }
            else{
                $passrate=$passed*100/$all;
                $failrate=100-$passrate;
            }
            if(is_float($passrate)){
                $passrate = number_format($passrate, 2, '.', '');
                $failrate = number_format($failrate, 2, '.', '');
            }
                  // mysqli_close($conn);
            ?>
        </tbody>
         </table>
         <div>  <br/></div>
        <div>  Percentage of passing: <?php echo $passrate; ?>%</div>
        <div>  Percentage of failing: <?php echo $failrate; ?>%</div>
     </div>
          <div class="tab-pane" id="commerce">
              <table style= "background-color: grey; color: black; width:80%;" >
                <thead>
                  <tr style= "text-align:left;">
                    <th>Year</th>
                    <th>Group</th>
                    <th>Roll</th>
                    <th>CGPA</th>
                </tr>
            </thead>
            <tbody>
              <?php 
              $code=$_SESSION["code"];
              $sql="SELECT result_info.year,student_academic_info.group,result_info.student_roll,result_info.cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll where student_academic_info.institute_code='$code' and student_academic_info.group='Commerce'";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                echo "<tr><td>{$row["year"]}</td><td>{$row["group"]}</td><td>{$row["student_roll"]}</td><td>{$row["cgpa"]}</td></tr>\n";
            }
            $sql="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code' and student_academic_info.group='Commerce'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $all=$row["all_cgpa"];
            $sql="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code' and student_academic_info.group='Commerce' and result_info.cgpa>0";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $passed=$row["passed_cgpa"];
            if($all==0){
                $passrate=0;
                $failrate=0;
            }
            else{
                $passrate=$passed*100/$all;
                $failrate=100-$passrate;
            }
            if(is_float($passrate)){
                $passrate = number_format($passrate, 2, '.', '');
                $failrate = number_format($failrate, 2, '.', '');
            }
                  // mysqli_close($conn);
            ?>
        </tbody>
         </table>
         <div>  <br/></div>
        <div>  Percentage of passing: <?php echo $passrate; ?>%</div>
        <div>  Percentage of failing: <?php echo $failrate; ?>%</div>
          </div>
          <div class="tab-pane" id="arts">
              <table style= "background-color: grey; color: black; width:80%;" >
                <thead>
                  <tr style= "text-align:left;">
                    <th>Year</th>
                    <th>Group</th>
                    <th>Roll</th>
                    <th>CGPA</th>
                </tr>
            </thead>
            <tbody>
              <?php 
              $code=$_SESSION["code"];
              $sql="SELECT result_info.year,student_academic_info.group,result_info.student_roll,result_info.cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll where student_academic_info.institute_code='$code' and student_academic_info.group='Arts'";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                echo "<tr><td>{$row["year"]}</td><td>{$row["group"]}</td><td>{$row["student_roll"]}</td><td>{$row["cgpa"]}</td></tr>\n";
            }
            $sql="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code' and student_academic_info.group='Arts'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $all=$row["all_cgpa"];
            $sql="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code' and student_academic_info.group='Arts' and result_info.cgpa>0";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $passed=$row["passed_cgpa"];
            if($all==0){
                $passrate=0;
                $failrate=0;
            }
            else{
                $passrate=$passed*100/$all;
                $failrate=100-$passrate;
            }
            if(is_float($passrate)){
                $passrate = number_format($passrate, 2, '.', '');
                $failrate = number_format($failrate, 2, '.', '');
            }
                  // mysqli_close($conn);
            ?>
        </tbody>
         </table>
         <div>  <br/></div>
        <div>  Percentage of passing: <?php echo $passrate; ?>%</div>
        <div>  Percentage of failing: <?php echo $failrate; ?>%</div>
          </div>
      </div>
    	
        <div>  <br/></div>
    	<div id="footer">
    		<p>Contact information: <a href="someone@example.com">
               someone@example.com</a>.
            </p>
    	</div>
    </div>
</body>
</html>