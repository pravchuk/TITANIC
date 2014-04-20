<?php
//Database specs
// Database name = Titanic
// Database username = username
// Database password = password
// Table name = HighScores
// Column1 = person (TEXT)
// Column2 = score (INT(3))
// Column3 = email (TEXT)
// POST TO localhost..../backend.php?todo=post
// GET TO localhost..../backend.php

$todo=$_GET['todo']; //post or get


if($todo=='post'){
$person = $_POST['person'];
$score = $_POST['score'];
$email = $_POST['email'];
}

$con=mysql_connect("localhost","username","password");
// Check connection
if (!$con)
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$db_selected = mysql_select_db('Titanic',$con);

if($todo=='post'){
	$result = mysql_query($con,"SELECT * FROM HighScores");
	$temp = "";
	while($row = mysql_fetch_array($result))
	{
		if($row['person']==$person){
			if($score>$row['score']){
				$temp = "update";
			}
		}
		echo '<tr><td>'.$row['person'] . "</td><td>" . $row['score'] . '</td></tr>';
	}

	if($temp=="update"){
		$query = mysql_query("UPDATE HighScores SET person = '$person', score = $score, email = '$email')");
	}else{
		$query = mysql_query("INSERT INTO HighScores VALUES ('$person',$score,'$email')");
	}
	if($query){
		echo "Succesfully Updated";
	}else{
		echo "Error updating database";
	}
}
else{

$result = mysql_query("SELECT * FROM HighScores ORDER BY score DESC");

echo '<table><tr><td>Name</td><td>Score</td></tr>';

while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$row['person'] . "</td><td>" . $row['score'] . '</td></tr>';
  }
  echo '</table>';
 }

mysql_close($con);
?>