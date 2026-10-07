<?php

require_once 'DBConnect.php';
require 'User.class.php';

$db = new DBConnect();
$db_handle = $db->getConnection();

$user = new User($db_handle);
$user->showUsers();