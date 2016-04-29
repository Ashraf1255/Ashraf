<?php
// Start the session
session_start();
?>
    <?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>
<?php 
    header("Location: menu.php");
    exit();
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
    		<img src="pic/board.png">
    	</div>
    	<div>You're not logged in.<a href="admin.php">Click Here</a> to log in.</div>
    	<div><a href="menu.php">Clck here</a> to go to home page.</div>
    	<div id="footer">
    		<p>Contact information: <a href="someone@example.com">
               someone@example.com</a>.
            </p>
    	</div>
    </div>

</body>
</html>