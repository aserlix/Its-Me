<?php
require ("../auth/loggedIn.php");
require ("../../controllers/db/connection.php");

if (isset($_SESSION["guid"])) {
    $guid = $_SESSION["guid"];}

try{
    $sql = "SELECT id FROM details 
            WHERE guid='$guid'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetch();

}catch (PDOException $e) {
    echo "Error finding your account" . $e->getMessage();
}

$id=$results['id'];

header("Location: ../../views/landing/singleProfile.php?id=$id");