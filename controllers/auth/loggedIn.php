<?php
session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    $_SESSION["notLoggedIn"] = TRUE;
    header("Location: ../auth/login.php");
}