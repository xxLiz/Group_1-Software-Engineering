<?php
require 'ProcessLogin.php'; // Include the process_login class definition
session_start(); 
$processlogin=new ProcessLogin(new DbOperations());
$processlogin->loginUser();
