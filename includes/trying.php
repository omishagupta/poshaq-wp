<?php 
 
if( $_POST ) {
	$con=mysql_connect("localhost", "root", "root");
	if (!$con) {
		die ("could not connect: " . mysql_error);
	}
	mysql_select_db("shahbaz", $con);
	$comments = $_POST['comment'];
	$query="INSERT INTO `shahbaz`.`table1` (`column1`) VALUES ('$comments');";
	mysql_query($query);
	echo "thankyou for query"; 
}
?>