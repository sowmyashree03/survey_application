<html>
    <head>
	<?php
   session_start(); //starts the session
   if($_SESSION['user']){ // checks if the user is logged in  
   }
   else{
      header("location: index.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value
   ?>

       <style>
	   tr{
		   text-align: center;
	   }
	   
div.container {
    width: 100%;
    /*border: 1px solid gray;*/
	font-size: 110%;
	
}

header{
	
    padding: 1em;
    color: white;
    background-color: black;
    clear: left;
    text-align: center;
	
}
article {
	height:100%;
    margin-left: 20px;
    /*border-left: 1px solid gray;*/
    padding: 1em;
    overflow: hidden;
	
}

footer {
	padding: 1em;
    color: white;
    background-color: black;
    clear: left;
    text-align: center;
    bottom: 0;
	position: absolute;
	width:98%;
	}
</style>
    </head>
    <body>
		<?php
			mysql_connect("localhost","root","") or die(mysql_error());
			mysql_select_db("survey") or die("Cannot connect to database");
			$result = mysql_query("SELECT * FROM survey_tab");
		?>
        <div class="container">
		<header><h1> SURVEY LIST </h1> </header>
		<article>
				<h1 style="text-align:left; position:fixed; bottom:40"> <button type="button" onClick="window.location.href='home.php'"> BACK </button></h1>

		<table border="2" align="center" style="width: 50%">
			<tr>
			<th>SURVEY ID</th>
			<th>SURVEY TITLE</th> 
			</tr>
			<?php  
			if( mysql_num_rows( $result )==0 ){
				echo '<tr><td colspan="4">No Rows Returned</td></tr>';
			}else{
				while( $row = mysql_fetch_assoc( $result ) ){
					echo "<tr><td> {$row['Survey_id']}</td><td>{$row['s_title']}</td></tr>\n";
				}
			}
		?>
				
		</table>
		
		<br><br><br><br><br>
	
		<form style="text-align:center" method="post">
	<!--<label for="survey_id"> Survey_id <input type="text" name="survey_id" required="required" /> -->
	 <select name="s1_id">
	 <option value="">--select--</option>
      <br>
	<?php
mysql_connect("localhost","root","");
mysql_select_db("survey");
$select="survey";
if(isset($select)&&$select!=""){
$select=$_POST['s1_id'];
}
?>
<?php
$list=mysql_query("select Survey_id from survey_tab");
while($row_list=mysql_fetch_assoc($list)){
?>
<option value="<?php echo $row_list['Survey_id']; ?>">
 <?php if($row_list['Survey_id']==$select) ?>
 <?php echo $row_list['Survey_id']; ?>
</option>
<?php
}
?>
</select>
	<button type="submit" value="submit">DELETE!</button>
	</form>
	
	</article>
	<footer> <a href = "logout.php"logout </a>
	</footer>
	</body>
	</html>
	
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("survey") or die("Cannot connect to database");
	$survey_id = mysql_real_escape_string($_POST['survey_id']);
	mysql_query("DELETE FROM survey_tab WHERE Survey_id = '$select';");
	Print '<script>window.location.assign("home.php");</script>';
	}
?>