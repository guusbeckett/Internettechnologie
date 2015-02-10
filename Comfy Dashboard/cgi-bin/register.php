<?php

$con=new mysqli("localhost","ipac_user","kissFM","ipac_user");

// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	if ($_GET['q'] === "setname")
	{
		$data = file_get_contents('https://reupload.nl/cgi-bin/api.php?q=checkid&id='.$_GET['id']);
		if ($data === "1")
		{
			$query = "UPDATE radios SET NAME='".$_GET['name']."' WHERE ID=".$_GET['id'];

			$result = $con->query($query);

			echo "{\"result\":\"ID ".$_GET['id']." linked to ".$_GET['name']."\"}";
		}
		else
			echo "{\"result\":\"ID ".$_GET['id']." does not exist\"}";
	}
	else
	{
		$query = "INSERT INTO radios (NAME) VALUES ('')";
		#$query = "DELETE FROM radios";


		$con->query($query);

		#mysqli_close($con);

		print $con->insert_id;
	}
	$con->close();
}

?>
