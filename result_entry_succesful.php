<?php
// Start the session
session_start();
?>
<?php 
	if(!$_SESSION["news"]){
    header("Location: logout.php");
    exit();
}
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
    	<div>
    		<h5><?php echo $_SESSION["news"]; ?></h5>

    	</div>
    	<div><a href="admin_file.php">Enter data for different student</a></div>
    	
    	<div id="footer">
    		<p>Contact information: <a href="someone@example.com">
               someone@example.com</a>.
            </p>
    	</div>
    </div>

</body>
</html>