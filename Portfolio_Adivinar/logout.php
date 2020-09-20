<?php
//include 'connectiontwo.php';
session_start();
session_destroy();
header('location:home.php');

?>