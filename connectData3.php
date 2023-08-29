<?php

$mysqli = new mysqli('localhost', 'module3','mod3pass','newssite');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}