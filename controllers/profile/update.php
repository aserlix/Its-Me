<?php

require('../db/connection.php');

if (isset($_POST)) {

    if (

    !empty($_POST['businessName'])) {
        session_start();
        $guid = $_SESSION['guid'];
        $businessName = $_POST['businessName'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $postCode = $_POST['postCode'];
        $aboutBusiness = $_POST['aboutBusiness'];
        try {
            $sql = "UPDATE details 
        SET businessName = '".$businessName."',
        street = '".$street."',
        city = '$city',
        country = '$country',
        postCode = '$postCode',
        aboutBusiness = '$aboutBusiness'
        WHERE guid='$guid'";

            $conn->exec($sql);
            header('Location: ../../views/dashboard/profile.php');

        } catch (PDOException $e) {
            echo "Error updating details" . $e->getMessage();
        }
    }
}

