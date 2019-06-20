<?php

$connection = mysqli_connect("localhost",'root','','stp_bus');

if(!$connection) {
	die("Unable to connect" . mysqli_error($connection));
}

?>