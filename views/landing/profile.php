<?php
require ("../../controllers/db/connection.php");
session_start();
if (isset($_SESSION["loggedIn"])) {
    $loggedIn = $_SESSION["loggedIn"];
}
if (isset($loggedIn)) {
    require ("../layout/loggedInHeader.php");
}else{
    require ("../layout/headerWithLogin.php");
}

try{
    $sql = "SELECT * FROM details WHERE businessName IS NOT NULL";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

}catch (PDOException $e) {
    echo "Error adding an account" . $e->getMessage();
}

if(count($results)>0){
    foreach($results as $profile){
        ?>
        <div>
            <h3><?php
                echo($profile['businessName']);
                ?></h3>
            <a href="./singleProfile.php?id=<?php echo($profile['id']); ?>">Click me</a>
        </div>





        <?php
    }
}
?>

