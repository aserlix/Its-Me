<?php

require ('../../controllers/auth/loggedIn.php');

if (isset($_SESSION["loggedIn"])) {
    $loggedIn = $_SESSION["loggedIn"];
}
if (isset($loggedIn)) {
    require ("../layout/loggedInHeader.php");
}else{
    require ("../layout/headerWithLogin.php");
}
require ('../../controllers/db/connection.php');



try{
    $guid=$_SESSION["guid"];
    if ($guid){
        $sql = "SELECT * FROM details
                WHERE guid='$guid'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

// set the resulting array to associative
        $profileDetails = $stmt->fetch();
    }


}catch(PDOException $e) {
    echo "Error adding an account" . $e->getMessage();}
?>
<div class="form">
    <div class="inputs">
        <p>Profile Details</p>
        <form class="inputs" action="../../controllers/profile/update.php" method="post">
            <input type="text" value="<?php echo $profileDetails['businessName'] ?>" placeholder="Business Name" name="businessName"  required />
            <input type="text" value="<?php echo $profileDetails['street'] ?>" placeholder="Street" name="street"/>
            <input type="text" value="<?php echo $profileDetails['city'] ?>" placeholder="City" name="city"  required />
            <input type="text" value="<?php echo $profileDetails['country'] ?>" placeholder="Country" name="country"  required />
            <input type="text" value="<?php echo $profileDetails['postCode'] ?>" placeholder="Post Code" name="postCode"/>
            <input type="text" value="<?php echo $profileDetails['aboutBusiness'] ?>" placeholder="About You" name="aboutBusiness"  required />
            <button class="btn btn-info">Update</button>
        </form>
        <form action="../../controllers/profile/get.php">
            <p></p>
            <button>Check Your profile view</button>
        </form>
    </div>
</div>