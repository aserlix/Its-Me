<?php
session_start();
if (isset($_SESSION["loggedIn"])) {
    $loggedIn = $_SESSION["loggedIn"];
}
if (isset($loggedIn)) {
    require ("../layout/loggedInHeader.php");
}else{
    require ("../layout/headerWithLogin.php");
}
require ("../../controllers/db/connection.php");
include("../../utilities/getMaps.php");

$id=$_GET['id'];


try{
    if ($id){
        $sql = "SELECT * FROM details
                WHERE id='$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $profileDetails = $stmt->fetch();
    }

    $url ='https://api.mapbox.com/geocoding/v5/mapbox.places/';
    $street=($profileDetails['street']);
    $postCode=($profileDetails['postCode']);
    $city=($profileDetails['city']);
    $urlData=$street.' '.$postCode.' '.$city;
    $urlData = urlencode($urlData);
    $urlEnd ='.json?access_token=pk.eyJ1IjoiYXNlcmxpeCIsImEiOiJjazd2dXM4N3UxY2tyM29tcmduZDY1anppIn0.rtIl55V5CC6sPEY0EvAxjA';
    $url=$url.''.$urlData.''.$urlEnd;
    $cord=CallAPI($url);

    ?>
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
    <div class="form">
        <h1><?php echo($profileDetails['businessName']) ?></h1>
        <p><b>address</b></p><p></p><?php echo($profileDetails['street']);echo(" "); echo($profileDetails['city']) ?></p>
        <p><?php echo($profileDetails['country']) ?></p>
        <p><?php echo($profileDetails['postCode']) ?></p>
        <div id='map' style='width: 360px; height: 300px;'></div>
        <div class="map">

        <script>

            mapboxgl.accessToken = 'pk.eyJ1IjoiYXNlcmxpeCIsImEiOiJjazd2dXM4N3UxY2tyM29tcmduZDY1anppIn0.rtIl55V5CC6sPEY0EvAxjA';
            var map = new mapboxgl.Map({
                container: 'map', center: [<?php echo($cord[0]) ?>,
                    <?php echo($cord[1]) ?>], zoom: 15,
                style: 'mapbox://styles/mapbox/streets-v11'
            });
            var marker = new mapboxgl.Marker()
                .setLngLat([<?php echo($cord[0]) ?>,
                    <?php echo($cord[1]) ?>])
                .addTo(map);

        </script>
        </div>
        <p><b>about me!<b></b></p><p><?php echo($profileDetails['aboutBusiness']); ?></p>
    <?php
    if (isset($loggedIn)) {
            ?>
        <form action="../dashboard/profile.php">
            <br>
            <button>Edit your details</button>
        </form>

        <form action="../../utilities/qrCode.php">
            <br>
            <button>Generate QR code</button>
        </form>
        </div>
        <?php
        }


}catch(PDOException $e) {
    echo "Error adding an account" . $e->getMessage();}
require ("../layout/footer.php");
?>