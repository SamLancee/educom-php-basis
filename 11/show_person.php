<?php
require "dbconnect.php";
require "person.php";

$db = new DBConnect();
$db_handle = $db->getConnection();

$person = new Person($db_handle);
$person->showPersons();