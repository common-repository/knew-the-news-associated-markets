<?php

require_once("httpclient.php");

$base_path = "/";

$client = new httpclient();
$client->debug = false;

$path = $base_path . $_GET["url"];

header('Content-type: application/xml');

if ($_POST) {

	print $client->postToHost($path, $_POST);
	
} else  {

	print $client->getFromHost($path);
}
