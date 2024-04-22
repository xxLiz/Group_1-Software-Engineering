<?php
require 'process_login.php'; // Include the process_login class definition
session_start(); 
$processlogin=new Process_login(new DbOperations());
$processlogin->loginUser();
