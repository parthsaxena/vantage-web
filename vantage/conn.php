<?php

	$conn =	mysqli_connect("scapter.org", "root", "rroot451", "pinder");
	if (!$conn) {
		 echo "Unable to establish connection to database. " . mysqli_connect_error();
		 exit;
	}

?>
