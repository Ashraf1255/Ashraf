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
    	<form action="student_result.php" method="get">
             <div>
                 Examination:
                 <select>
                         <option value="ssc" >SSC</option>
                         <option value="hsc">HSC</option>
                         <option value="Alim">Alim</option>
                         <option value="Dakhil">Dakhil</option>
                 </select>
             </div>
             <div>
                 Board:
                 <select>
                         <option value="board" selected="selected">Select one</option>
                         <option value="board">Dhaka</option>
                         <option value="board">Comilla</option>
                         <option value="board">Dinajpur</option>
                         <option value="board">Sylhet</option>
                         <option value="board">Chittagong</option>
                         <option value="board">Rajshahi</option>
                         <option value="board">Jessore</option>
                         <option value="board">Barisal</option>
                         <option value="board">Madrasah Board</option>
                         <option value="board">Technical Board</option>
                 </select>
             </div>
             <div>
                 Year:
                 <select>
                         <option value="Year" selected="selected">Select one</option>
                         <option value="Year">2015</option>
                         <option value="Year">2014</option>
                         <option value="Year">2013</option>
                         <option value="Year">2012</option>
                         <option value="Year">2011</option>
                         <option value="Year">2010</option>
                         
                 </select>
             </div>
             <div>
                
                 <input type="text" name="roll" placeholder="Student Roll">
             </div>
             
             <div>
                 <input type="reset" value="Reset">
                 <input type="submit" value="Submit">
             </div>
        </form>
    	<div id="footer">
    		<p>Contact information: <a href="someone@example.com">
               someone@example.com</a>.
            </p>
    	</div>
    </div>
</body>
</html>