<?php
session_start(); 

unset($_SESSION['updateBoolean']);
unset($_SESSION['addBoolean']);

header('Location: ../inventory.php');
exit;
?>