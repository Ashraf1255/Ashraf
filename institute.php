<?php
// Start the session
session_start();
?>
<?php
if(isset($_SESSION["code"]) && !empty($_SESSION["code"])){
    header("Location: institute_result.php");
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

if($_POST){
    $board_name=$_POST["board"];
    $code=$_POST["code"];
    $password=$_POST["password"];
    $sql="SELECT * FROM institute where institute_code='$code'";
    $result = mysqli_query($conn, $sql);
            //initialize error
    $errors=array();
    $row = mysqli_fetch_assoc($result);

    $sql_institute_name=$row["institute_name"];
    $sql_institute_code=$row["institute_code"];
    $sql_institute_email=$row["institute_email"];
    $sql_institute_pass=$row["institute_password"];
    $sql_board_name=$row["board_name"];
    echo $sql_institute_name. "  -  " . $sql_institute_code."  -  " .$sql_institute_email."  -  " .$sql_institute_pass."  -  " .$sql_board_name. "<br>";

    // error validation
    if(empty($_POST["code"])){
        $errors["code_error"]="Institute code can't be empty.";
    }

    else if (mysqli_num_rows($result)==0){
        $errors["code_invalid"]="Code doesn't exists";
    } 
    if(empty($_POST["password"])){
        $errors["pass_error"]="Password can't be empty.";
    }
    else if($password!=$sql_institute_pass){
        $errors["pass_invalid"]="Password doesn't match";
    }
    if($_POST["board"]=="board"){
        $errors["board_error"]="Select one board.";
    }
    else if($board_name!=$sql_board_name){
        $errors["board_invalid"]="Select correct board.";
    }
    $_SESSION["code"]=$sql_institute_code;
    //error checking and allowence
    if(count($errors)==0){
        header("Location: institute_result.php");
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
            <a href="menu.php"><h2>Secondary School Certificate Examination Result</h2></a>
        </div>
        
    	
        <div class="main">
            <form  method="post">
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
                 Board &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
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
             Institute Code &nbsp;:
                 <input type="text" name="code" placeholder="Institute Code" style="width:200px;text-align: center;">
            <?php 
            if (isset($errors["code_error"])){
            echo $errors["code_error"];
            }
            else if (isset($errors["code_invalid"])) {
            echo $errors["code_invalid"];
            }
            ?><br>
             </div>
             <br>
             <?php 
               if (isset($errors["year_error"])){
                    echo $errors["year_error"];
                }
            ?>
             <div>
                Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                 <input type="password" name="password" placeholder="Password" style="width:200px;text-align: center;">
             <?php 
                if (isset($errors["pass_error"])){
                echo $errors["pass_error"];
                }
                else if (isset($errors["pass_invalid"])) {
                 echo $errors["pass_invalid"];
                }
            ?>
            </div>
            <br>
             <div id="new">
                 <input type="submit" value="Log in">
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