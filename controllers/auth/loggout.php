<?php
session_start();
if (isset($_SESSION["loggedIn"])) {
    session_destroy();
}
if (isset($_SESSION["guid"])) {
    session_destroy();
}
if (isset($_SESSION["username"])) {
    session_destroy();
}
if (isset($_SESSION["id"])) {
    session_destroy();
}
header("Location: ../../index.php");