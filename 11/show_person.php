<?php
require once "dbconnect.php"; //voor 1x
require "person.php";

$db = new DBConnect();
$db_handle = $db->getConnection();

$person = new Person($db_handle);
$person->showPersons();