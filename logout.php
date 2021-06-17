<?php
session_start();

if(isset($_SESSION['Username']) && $_SESSION['Username'] != NULL){
    unset($_SESSION['Username']);
}
    header("location: index.php");
?>