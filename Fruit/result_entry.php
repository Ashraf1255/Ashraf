<?php
// Start the session
session_start();
?>
<?php
if(!$_SESSION["institute_code"]){
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

    $roll=$_SESSION["roll"];
    $code=$_SESSION["institute_code"]; 
    echo $roll." ".$code."<br/>";
    //todo edit
    $sql="SELECT student_academic_info.roll,student_personal_info.student_name,student_academic_info.group FROM student_academic_info join student_personal_info on student_academic_info.roll= student_personal_info.roll where student_academic_info.roll='$roll' and student_academic_info.institute_code='$code'";
    $result = mysqli_query($conn, $sql);
   
    $row = mysqli_fetch_assoc($result);

    $sql_roll=$row["roll"];

    $sql_name=$row["student_name"];
    //$_SESSION["name"]=$sql_name;
    $sql_group=$row["group"];
    echo $sql_roll. "  -  " .$sql_name."  -  " .$sql_group. "<br>";
    $sub1="Bangla I";$sub2="Bangla II";$sub3="English I";$sub4="English II";$sub5="Mathematics";$sub6="Religion";
    $sub1code=101;$sub2code=102;$sub3code=103;$sub4code=104;$sub5code=105;$sub6code=106;
    if($sql_group=="Science"){
        $sub7="Social Science";$sub8="Physics";$sub9="Chemistry";$sub10="Biology";$sub11="Higher Mathematics";
        $sub7code=107;$sub8code=108;$sub9code=109;$sub10code=110;$sub11code=111;
    }
    else if($sql_group=="Commerce"){
        $sub7="General Science";$sub8="Accounting";$sub9="Business Contacts";$sub10="Business Initiatives";$sub11="Agriculture";
        $sub7code=112;$sub8code=113;$sub9code=114;$sub10code=115;$sub11code=116;
    }
    else if($sql_group=="Arts"){
        $sub7="General Science";$sub8="History";$sub9="Economics";$sub10="Geography";$sub11="Agriculture";
        $sub7code=112;$sub8code=117;$sub9code=118;$sub10code=119;$sub11code=120;
    }

//todo edit
if($_POST){
    $c[1]=$_POST["sub1"];
    $c[2]=$_POST["sub2"];
    $c[3]=$_POST["sub3"];
    $c[4]=$_POST["sub4"];
    $c[5]=$_POST["sub5"];
    $c[6]=$_POST["sub6"];
    $c[7]=$_POST["sub7"];
    $c[8]=$_POST["sub8"];
    $c[9]=$_POST["sub9"];
    $c[10]=$_POST["sub10"];
    $c[11]=$_POST["sub11"];
    //echo $c1.$com1;

    //initialize error
    $errors=array();
    // error validation
    if(empty($_POST["sub1"])||empty($_POST["sub2"])||empty($_POST["sub3"])||empty($_POST["sub4"])||empty($_POST["sub5"])||empty($_POST["sub6"])||empty($_POST["sub7"])||empty($_POST["sub8"])||empty($_POST["sub9"])||empty($_POST["sub10"])||empty($_POST["sub11"])){
        $errors["com_error"]="Fill all the blanks.";
    }

    else if (!is_numeric($_POST["sub1"])||!is_numeric($_POST["sub2"])||!is_numeric($_POST["sub3"])||!is_numeric($_POST["sub4"])||!is_numeric($_POST["sub5"])||!is_numeric($_POST["sub6"])||!is_numeric($_POST["sub7"])||!is_numeric($_POST["sub8"])||!is_numeric($_POST["sub9"])||!is_numeric($_POST["sub10"])||!is_numeric($_POST["sub11"])){
        $errors["com_invalid"]="Enter correct value";
    }

    //convert numbers into grade
    for($i=1;$i<=11;$i++){
        if($c[$i]>=80){
            $c[$i]=5;
        }
        else if($c[$i]>=70){
            $c[$i]=4;
        }
        else if($c[$i]>=60){
            $c[$i]=3.5;
        }
        else if($c[$i]>=50){
            $c[$i]=3;
        }
        else if($c[$i]>=40){
            $c[$i]=2;
        }
        else if($c[$i]>=33){
            $c[$i]=1;
        }
        else{
            $c[$i]=0;
        }
    }
    echo $c[1]." ".$sub1." ".$sub1code." <br/>";
    //making cgpa
    $flag=1;$cgpa=0;$fourth=0;
    if($c[11]>2){
        $fourth=$c[11]-2;
    }
    for($i=1;$i<=11;$i++){
        if($c[$i]==0){
            $flag=0;
        }
    }
   
    if($flag!=0){
        $cgpa+=($c[1]+$c[2])/2;
        $cgpa+=($c[3]+$c[4])/2;
        for($i=5;$i<=10;$i++){
            $cgpa+=$c[$i];
        }
        $cgpa+=$fourth;
        $cgpa/=8;
    }
    $cgpa = number_format($cgpa, 2, '.', '');
    echo " ".$cgpa;
    //todo edit
    $sql="INSERT INTO subject_wise_result (subject_name, subject_code, subject_gpa, student_roll) VALUES ('$sub1', '$sub1code', '$c[1]', '$roll'),('$sub2', '$sub2code', '$c[2]', '$roll'),('$sub3', '$sub3code', '$c[3]', '$roll'),('$sub4', '$sub4code', '$c[4]', '$roll'),('$sub5', '$sub5code', '$c[5]', '$roll'),('$sub6', '$sub6code', '$c[6]', '$roll'),('$sub7', '$sub7code', '$c[7]', '$roll'),('$sub8', '$sub8code', '$c[8]', '$roll'),('$sub9', '$sub9code', '$c[9]', '$roll'),('$sub10', '$sub10code', '$c[10]', '$roll'),('$sub11', '$sub11code', '$c[11]', '$roll')";
    $result=mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION["news"]="Data successfully entered";
    } 
    else {
        $errors["insert_error"]="Data inserting error.";
    }
    $sql="UPDATE result_info SET cgpa ='$cgpa' WHERE student_roll ='$roll' ";
    $result=mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION["news"]="Data successfully entered";
    } 
    else {
        $errors["insert_error"]="Data inserting error.";
    }
    //error checking and allowence
    if(count($errors)==0){
        header("Location: result_entry_succesful.php");
        exit();
    }

}
mysqli_close($conn);
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
    		<img src="pic/board.png">
    	</div>
        <div id="one">
            <button onclick="window.location.href='logout.php'">
                <p>Log out</p>
            </button>
        </div>
        <div><a href="admin_file.php">Enter data for different student</a></div>
        <div>
            <table style="width:100%">
                 <tr>
                      <td>Name: </td>
                     <td><?php echo $sql_name; ?></td> 
                </tr>
                <tr>
                    <td>Roll: </td>
                    <td><?php echo $sql_roll; ?></td> 
                </tr>
                <tr>
                    <td>Group: </td>
                    <td><?php echo $sql_group; ?></td> 
                </tr>
            </table>

        </div>
    	<form action="" method="post">
             <p><?php echo $sub1." "; ?><input type="text" name="sub1" </p>
             <p><?php echo $sub2." "; ?><input type="text" name="sub2"</p>
             <p><?php echo $sub3." "; ?><input type="text" name="sub3"</p>
             <p><?php echo $sub4." "; ?><input type="text" name="sub4"</p>
             <p><?php echo $sub5." "; ?><input type="text" name="sub5"</p>
             <p><?php echo $sub6." "; ?><input type="text" name="sub6"</p>
             <p><?php echo $sub7." "; ?><input type="text" name="sub7"</p>
             <p><?php echo $sub8." "; ?><input type="text" name="sub8"</p>
             <p><?php echo $sub9." "; ?><input type="text" name="sub9"</p>
             <p><?php echo $sub10." "; ?><input type="text" name="sub10"</p>
             <p><?php echo $sub11." "; ?><input type="text" name="sub11"</p>
             <p><?php 
               if (isset($errors["com_error"])){
                    echo $errors["com_error"];
                }
                else if (isset($errors["com_invalid"])) {
                    echo $errors["com_invalid"];
                }
            ?></p>
             <p><input type="submit" value="Submit"></p>
             <p><?php 
               if (isset($errors["insert_error"])){
                    echo $errors["insert_error"];
                }
            ?></p>
        </form>
    	<div id="footer">
    		<p>Contact information: <a href="someone@example.com">
               someone@example.com</a>.
            </p>
    	</div>
    </div>
    
</body>
</html>