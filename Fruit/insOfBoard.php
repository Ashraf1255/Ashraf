<?php
// Start the session
session_start();
?>
<?php
if(!$_SESSION["board_name"]){
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
$board_name=$_SESSION["board_name"];
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
    		<a href="menu.php"><img src="pic/board.png"></a>
    	</div>
    	<div id="two">
            <button onclick="window.location.href='admin.php'">
                <p>Admin Page</p>
            </button>
        </div>
        <div id="two">
            <button onclick="window.location.href='logout.php'">
                <p>Log out</p>
            </button>
        </div>
        <div>  <br/></div>
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all" data-toggle="tab">All</a></li>
          <li><a href="#science" data-toggle="tab">Science</a></li>
          <li><a href="#commerce" data-toggle="tab">Commerce</a></li>
          <li><a href="#arts" data-toggle="tab">Arts</a></li>
      </ul>
      <div class="tab-content">
          <div class="tab-pane active" id="all">
        <?php 
        	$sql="SELECT distinct(institute.institute_code) FROM result_info join institute on result_info.board=institute.board_name WHERE institute.board_name='$board_name'";
        	$result = mysqli_query($conn, $sql);
        	$i=1;
        	while($row = mysqli_fetch_assoc($result)){
        		$code[$i]=$row["institute_code"];
        		$query="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code[$i]'";
        		$res = mysqli_query($conn, $query);
        		if ($ro = mysqli_fetch_assoc($res)) {
        			$all[$i]=$ro["all_cgpa"];
        			$query="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code[$i]' and result_info.cgpa>0";
        			$res = mysqli_query($conn, $query);
        			$ro = mysqli_fetch_assoc($res);
        			$passed[$i]=$ro["passed_cgpa"];
        			$failed[$i]=$all[$i]-$passed[$i];
        			if($all[$i]==0){
        				$passrate[$i]=0;
        				$failrate[$i]=0;
        			}
        			else{
        				$passrate[$i]=$passed[$i]*100/$all[$i];
        				$failrate[$i]=100-$passrate[$i];
        			}
        			if(is_float($passrate[$i])){
        				$passrate[$i] = number_format($passrate[$i], 2, '.', '');
        				$failrate[$i] = number_format($failrate[$i], 2, '.', '');
        			}
        			$query="SELECT distinct(institute.institute_name) as institute_name FROM institute join student_academic_info on institute.board_name=student_academic_info.board_name WHERE institute.institute_code='$code[$i]'";
        			$res = mysqli_query($conn, $query);
        			$ro = mysqli_fetch_assoc($res);
        			$name[$i]=$ro["institute_name"];
        			//echo $name[$i]." ".$code[$i]." ".$all[$i]." ".$passed[$i]." ".$failed[$i]." ".$passrate[$i]." ".$failrate[$i];
        		
        		}
        		
        		$i++;
        	}
         ?>
         <table style= "background-color: grey; color: black; width:80%;" >
            <thead>
              <tr style= "text-align:left;">
              	<th>Institute Name</th>
                <th>Institute Code</th>
                <th>Students no.</th>
                <th>Passed students no.</th>
                <th>Failed students no.</th>
                <th>Percentage of passing</th>
                <th>Percentage of failing</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              		//echo $i;
              		$j=1;
              		//echo $code[$j]." ".$all[$j]." ".$passed[$j]." ".$failed[$j]." ".$passrate[$j]." ".$failrate[$j];
                  while($j<$i){
                  	echo "<tr>";
                  	echo "<td>";echo $name[$j];echo "</td>";
                  	echo "<td>";echo $code[$j];echo "</td>";
                  	echo "<td>";echo $all[$j];echo "</td>";
                  	echo "<td>";echo $passed[$j];echo "</td>";
                  	echo "<td>";echo $failed[$j];echo "</td>";
                  	echo "<td>";echo $passrate[$j];echo "%</td>";
                  	echo "<td>";echo $failrate[$j];echo "%</td>";
                    echo "</tr>";
                    echo "\n";
                    $j++;
                  }
                  //mysqli_close($conn);
               ?>
          </tbody>
          </table>
         </div>

         <div class="tab-pane" id="science">
                 <?php 
        	$sql="SELECT distinct(institute.institute_code) FROM result_info join institute on result_info.board=institute.board_name WHERE institute.board_name='$board_name'";
        	$result = mysqli_query($conn, $sql);
        	$i=1;
        	while($row = mysqli_fetch_assoc($result)){
        		$code[$i]=$row["institute_code"];
        		$query="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code[$i]' and student_academic_info.group='Science'";
        		$res = mysqli_query($conn, $query);
        		if ($ro = mysqli_fetch_assoc($res)) {
        			$all[$i]=$ro["all_cgpa"];
        			$query="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code[$i]' and student_academic_info.group='Science' and result_info.cgpa>0";
        			$res = mysqli_query($conn, $query);
        			$ro = mysqli_fetch_assoc($res);
        			$passed[$i]=$ro["passed_cgpa"];
        			$failed[$i]=$all[$i]-$passed[$i];
        			if($all[$i]==0){
        				$passrate[$i]=0;
        				$failrate[$i]=0;
        			}
        			else{
        				$passrate[$i]=$passed[$i]*100/$all[$i];
        				$failrate[$i]=100-$passrate[$i];
        			}
        			if(is_float($passrate[$i])){
        				$passrate[$i] = number_format($passrate[$i], 2, '.', '');
        				$failrate[$i] = number_format($failrate[$i], 2, '.', '');
        			}
        			$query="SELECT distinct(institute.institute_name) as institute_name FROM institute join student_academic_info on institute.board_name=student_academic_info.board_name WHERE institute.institute_code='$code[$i]'";
        			$res = mysqli_query($conn, $query);
        			$ro = mysqli_fetch_assoc($res);
        			$name[$i]=$ro["institute_name"];
        			//echo $name[$i]." ".$code[$i]." ".$all[$i]." ".$passed[$i]." ".$failed[$i]." ".$passrate[$i]." ".$failrate[$i];
        		
        		}
        		
        		$i++;
        	}
         ?>
         <table style= "background-color: grey; color: black; width:80%;" >
            <thead>
              <tr style= "text-align:left;">
              	<th>Institute Name</th>
                <th>Institute Code</th>
                <th>Students no.</th>
                <th>Passed students no.</th>
                <th>Failed students no.</th>
                <th>Percentage of passing</th>
                <th>Percentage of failing</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              		//echo $i;
              		$j=1;
              		//echo $code[$j]." ".$all[$j]." ".$passed[$j]." ".$failed[$j]." ".$passrate[$j]." ".$failrate[$j];
                  while($j<$i){
                  	echo "<tr>";
                  	echo "<td>";echo $name[$j];echo "</td>";
                  	echo "<td>";echo $code[$j];echo "</td>";
                  	echo "<td>";echo $all[$j];echo "</td>";
                  	echo "<td>";echo $passed[$j];echo "</td>";
                  	echo "<td>";echo $failed[$j];echo "</td>";
                  	echo "<td>";echo $passrate[$j];echo "%</td>";
                  	echo "<td>";echo $failrate[$j];echo "%</td>";
                    echo "</tr>";
                    echo "\n";
                    $j++;
                  }
                  //mysqli_close($conn);
               ?>
          </tbody>
          </table>
         </div>
         <div class="tab-pane" id="commerce">
                 <?php 
        	$sql="SELECT distinct(institute.institute_code) FROM result_info join institute on result_info.board=institute.board_name WHERE institute.board_name='$board_name'";
        	$result = mysqli_query($conn, $sql);
        	$i=1;
        	while($row = mysqli_fetch_assoc($result)){
        		$code[$i]=$row["institute_code"];
        		$query="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code[$i]' and student_academic_info.group='Commerce'";
        		$res = mysqli_query($conn, $query);
        		if ($ro = mysqli_fetch_assoc($res)) {
        			$all[$i]=$ro["all_cgpa"];
        			$query="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code[$i]' and student_academic_info.group='Commerce' and result_info.cgpa>0";
        			$res = mysqli_query($conn, $query);
        			$ro = mysqli_fetch_assoc($res);
        			$passed[$i]=$ro["passed_cgpa"];
        			$failed[$i]=$all[$i]-$passed[$i];
        			if($all[$i]==0){
        				$passrate[$i]=0;
        				$failrate[$i]=0;
        			}
        			else{
        				$passrate[$i]=$passed[$i]*100/$all[$i];
        				$failrate[$i]=100-$passrate[$i];
        			}
        			if(is_float($passrate[$i])){
        				$passrate[$i] = number_format($passrate[$i], 2, '.', '');
        				$failrate[$i] = number_format($failrate[$i], 2, '.', '');
        			}
        			$query="SELECT distinct(institute.institute_name) as institute_name FROM institute join student_academic_info on institute.board_name=student_academic_info.board_name WHERE institute.institute_code='$code[$i]'";
        			$res = mysqli_query($conn, $query);
        			$ro = mysqli_fetch_assoc($res);
        			$name[$i]=$ro["institute_name"];
        			//echo $name[$i]." ".$code[$i]." ".$all[$i]." ".$passed[$i]." ".$failed[$i]." ".$passrate[$i]." ".$failrate[$i];
        		
        		}
        		
        		$i++;
        	}
         ?>
         <table style= "background-color: grey; color: black; width:80%;" >
            <thead>
              <tr style= "text-align:left;">
              	<th>Institute Name</th>
                <th>Institute Code</th>
                <th>Students no.</th>
                <th>Passed students no.</th>
                <th>Failed students no.</th>
                <th>Percentage of passing</th>
                <th>Percentage of failing</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              		//echo $i;
              		$j=1;
              		//echo $code[$j]." ".$all[$j]." ".$passed[$j]." ".$failed[$j]." ".$passrate[$j]." ".$failrate[$j];
                  while($j<$i){
                  	echo "<tr>";
                  	echo "<td>";echo $name[$j];echo "</td>";
                  	echo "<td>";echo $code[$j];echo "</td>";
                  	echo "<td>";echo $all[$j];echo "</td>";
                  	echo "<td>";echo $passed[$j];echo "</td>";
                  	echo "<td>";echo $failed[$j];echo "</td>";
                  	echo "<td>";echo $passrate[$j];echo "%</td>";
                  	echo "<td>";echo $failrate[$j];echo "%</td>";
                    echo "</tr>";
                    echo "\n";
                    $j++;
                  }
                  //mysqli_close($conn);
               ?>
          </tbody>
          </table>
         </div>
         <div class="tab-pane" id="arts">
                 <?php 
        	$sql="SELECT distinct(institute.institute_code) FROM result_info join institute on result_info.board=institute.board_name WHERE institute.board_name='$board_name'";
        	$result = mysqli_query($conn, $sql);
        	$i=1;
        	while($row = mysqli_fetch_assoc($result)){
        		$code[$i]=$row["institute_code"];
        		$query="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code[$i]' and student_academic_info.group='Arts'";
        		$res = mysqli_query($conn, $query);
        		if ($ro = mysqli_fetch_assoc($res)) {
        			$all[$i]=$ro["all_cgpa"];
        			$query="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.institute_code='$code[$i]' and student_academic_info.group='Arts' and result_info.cgpa>0";
        			$res = mysqli_query($conn, $query);
        			$ro = mysqli_fetch_assoc($res);
        			$passed[$i]=$ro["passed_cgpa"];
        			$failed[$i]=$all[$i]-$passed[$i];
        			if($all[$i]==0){
        				$passrate[$i]=0;
        				$failrate[$i]=0;
        			}
        			else{
        				$passrate[$i]=$passed[$i]*100/$all[$i];
        				$failrate[$i]=100-$passrate[$i];
        			}
        			if(is_float($passrate[$i])){
        				$passrate[$i] = number_format($passrate[$i], 2, '.', '');
        				$failrate[$i] = number_format($failrate[$i], 2, '.', '');
        			}
        			$query="SELECT distinct(institute.institute_name) as institute_name FROM institute join student_academic_info on institute.board_name=student_academic_info.board_name WHERE institute.institute_code='$code[$i]'";
        			$res = mysqli_query($conn, $query);
        			$ro = mysqli_fetch_assoc($res);
        			$name[$i]=$ro["institute_name"];
        			//echo $name[$i]." ".$code[$i]." ".$all[$i]." ".$passed[$i]." ".$failed[$i]." ".$passrate[$i]." ".$failrate[$i];
        		
        		}
        		
        		$i++;
        	}
         ?>
         <table style= "background-color: grey; color: black; width:80%;" >
            <thead>
              <tr style= "text-align:left;">
              	<th>Institute Name</th>
                <th>Institute Code</th>
                <th>Students no.</th>
                <th>Passed students no.</th>
                <th>Failed students no.</th>
                <th>Percentage of passing</th>
                <th>Percentage of failing</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              		//echo $i;
              		$j=1;
              		//echo $code[$j]." ".$all[$j]." ".$passed[$j]." ".$failed[$j]." ".$passrate[$j]." ".$failrate[$j];
                  while($j<$i){
                  	echo "<tr>";
                  	echo "<td>";echo $name[$j];echo "</td>";
                  	echo "<td>";echo $code[$j];echo "</td>";
                  	echo "<td>";echo $all[$j];echo "</td>";
                  	echo "<td>";echo $passed[$j];echo "</td>";
                  	echo "<td>";echo $failed[$j];echo "</td>";
                  	echo "<td>";echo $passrate[$j];echo "%</td>";
                  	echo "<td>";echo $failrate[$j];echo "%</td>";
                    echo "</tr>";
                    echo "\n";
                    $j++;
                  }
                  //mysqli_close($conn);
               ?>
          </tbody>
          </table>
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