<?php

error_reporting(E_ALL);

# DEFINE CONSTANTS
define ("DATABASE","appWeego");
define ("USERNAME","root");
define ("PASSWORD","");
define ("SERVER","localhost");

# START DATABASE
$db = new PDO("mysql:host=".SERVER.";dbname=".DATABASE, USERNAME, PASSWORD) or die ("Error! Could not connect to database.");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->query("SET NAMES utf8;");

?>