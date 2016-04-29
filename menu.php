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
if($_POST){
    $board_name=$_POST["board"];
    $year=$_POST["year"];
    $roll=$_POST["roll"];
    $_SESSION["board"]=$board_name;
    $_SESSION["year"]=$year;
    $_SESSION["roll"]=$roll;
    $sql="SELECT student_academic_info.roll,student_academic_info.board_name,result_info.year FROM student_academic_info join result_info on student_academic_info.roll=result_info.student_roll where student_academic_info.roll='$roll' and result_info.year='$year'";
    $result = mysqli_query($conn, $sql);
    //initialize error
    $errors=array();
    $row = mysqli_fetch_assoc($result);
    $sql_roll=$row["roll"];
    $sql_board_name=$row["board_name"];
    $sql_year=$row["year"];
    echo $sql_roll. "  -  " .$sql_board_name."  -  " .$sql_year. "<br>";
    // error validation
    if(empty($_POST["roll"])){
        $errors["roll_error"]="Your roll can't be empty.";
    }
    else if (mysqli_num_rows($result)==0){
        $errors["roll_invalid"]="Check roll and year";
    } 
    if($_POST["year"]=="year"){
        $errors["year_error"]="Select one year.";
    }
    if($_POST["board"]=="board"){
        $errors["board_error"]="Select one board.";
    }
    else if($board_name!=$sql_board_name){
        $errors["board_invalid"]="Select correct board.";
    }
    //error checking and allowence
    if(count($errors)==0){
        header("Location: student_result.php");
        exit();
    }
}
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
        <div class="menu_bar">
            <div id="zero">
            
        </div>
        
        
        </div>
        <?php if(isset($_SESSION["board_name"]) && !empty($_SESSION["board_name"])): ?>
        <div id="two">
            <button onclick="window.location.href='admin.php'">
                <p>Admin Page</p>
            </button>
        </div>
        <?php endif; ?>
        <?php if(isset($_SESSION["code"]) && !empty($_SESSION["code"])): ?>
        <div id="two">
            <button onclick="window.location.href='institute.php'">
                <p>Institute page</p>
            </button>
        </div>
        <?php endif; ?>
        <?php if((isset($_SESSION["board_name"]) && !empty($_SESSION["board_name"]))||(isset($_SESSION["code"]) && !empty($_SESSION["code"]))): ?>
        <div id="two">
            <button onclick="window.location.href='logout.php'">
                <p>Log out</p>
            </button>
        </div>
        <?php else: ?>
        <div id="two">
            <button onclick="window.location.href='institute.php'">
                <p>INSTITUTE</p>
            </button>
            <button onclick="window.location.href='admin.php'">
                <p>ADMIN</p>
            </button>
        </div>
        <?php endif; ?>
        <div><br/></div>
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all" data-toggle="tab">All</a></li>
          <li><a href="#science" data-toggle="tab">Science</a></li>
          <li><a href="#commerce" data-toggle="tab">Commerce</a></li>
          <li><a href="#arts" data-toggle="tab">Arts</a></li>
      </ul>
      <div class="tab-content">
          <div class="tab-pane active" id="all">
              <?php 
            $sql="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $all=$row["all_cgpa"];
            $sql="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE result_info.cgpa>0";
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
         <div>  <br/></div>
        <div>  Percentage of passing: <?php echo $passrate; ?>%</div>
        <div>  Percentage of failing: <?php echo $failrate; ?>%</div>
          </div>
          <div class="tab-pane" id="science">
              <?php 
              $sql="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.group='Science'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $all=$row["all_cgpa"];
            $sql="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.group='Science' and result_info.cgpa>0";
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
          <?php 
            $sql="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.group='Commerce'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $all=$row["all_cgpa"];
            $sql="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.group='Commerce' and result_info.cgpa>0";
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
              <?php 
              $sql="SELECT COUNT(result_info.cgpa) AS all_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.group='Arts'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $all=$row["all_cgpa"];
            $sql="SELECT COUNT(result_info.cgpa) AS passed_cgpa FROM result_info join student_academic_info on result_info.student_roll=student_academic_info.roll WHERE student_academic_info.group='Arts' and result_info.cgpa>0";
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
        <div><br/></div>
        <div class="main">
            <form  method="post" action="student_result.php">
             <!-- <div>
                 Examination:
                 <select name="exam">
                         <option value="exam" selected="selected">Select one</option>
                         <option value="SSC" >SSC</option>
                         <option value="HSC">HSC</option>
                         <option value="Alim">Alim</option>
                         <option value="Dakhil">Dakhil</option>
                 </select>
             </div> -->
             <div class="board">
                 Board &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                 <select name="board" style="width:200px">
                         <option value="board" selected="selected">Select one</option>
                         <option value="Dhaka">Dhaka</option>
                         <option value="Comilla">Comilla</option>
                         <option value="Dinajpur">Dinajpur</option>
                         <option value="Sylhet">Sylhet</option>
                         <option value="Chittagong">Chittagong</option>
                         <option value="Rajshahi">Rajshahi</option>
                         <option value="Jessore">Jessore</option>
                         <option value="Barisal">Barisal</option>
                         <option value="Madrasah Board">Madrasah Board</option>
                         <option value="Technical Board">Technical Board</option>
                 </select><br>
             </div>
             <br>
             <?php 
               if (isset($errors["board_error"])){
                    echo $errors["board_error"];
                }
                else if (isset($errors["board_invalid"])) {
                    echo $errors["board_invalid"];
                }
            ?>
             <div>
                 Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                 <select name="year" style="width:200px">
                         <option value="year" selected="selected">Select one</option>
                         <option value="2015">2015</option>
                         <option value="2014">2014</option>
                         <option value="2013">2013</option>
                         <option value="2012">2012</option>
                         <option value="2011">2011</option>
                         <option value="2010">2010</option>
                         
                 </select><br>
             </div>
             <br>
             <?php 
               if (isset($errors["year_error"])){
                    echo $errors["year_error"];
                }
            ?>
             <div>
                Student Roll &nbsp;:
                 <input style="width:200px" type="text" name="roll" placeholder="Student Roll">
             </div>
             <br>
             <?php 
               if (isset($errors["roll_error"])){
                    echo $errors["roll_error"];
                }
                else if (isset($errors["roll_invalid"])) {
                    echo $errors["roll_invalid"];
                }
            ?>
             <div id="new">
                 <input type="reset" value="Reset">
                 <input type="submit" value="Submit">
             </div>
        </form>
        </div>
        <div id="footer">
            <p>Contact information: <a href="someone@example.com">
               someone@example.com</a>.
            </p>
        </div>
    </div>
</body>
</html>