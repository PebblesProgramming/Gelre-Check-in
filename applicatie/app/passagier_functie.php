<?php
require_once '../data/passagierData.php';
function displayPassengerDetails($passengerData)
{
    $passagierId = $passengerData['passagiernummer'];
    $passagierNaam = $passengerData['naam'];
    $vluchtnummer = $passengerData['vluchtnummer'];
    $geslacht = $passengerData['geslacht'];
    $balienummer = $passengerData['balienummer'];
    $stoel = $passengerData['stoel'];
    $inchecktijdstip = $passengerData['inchecktijdstip'];
    ?>
    <h1> Welkom bij Gelre-Check-In!</h1>
    <div class="row">
        <div class="col-1">
            <h1>Passagiersgegevens:</h1>
            <br>
            <h4>Passagier ID: <?php echo $passagierId; ?></h4>
            <p><strong>Naam:</strong> <?php echo $passagierNaam; ?></p>
            <p><strong>Vluchtnummer:</strong> <?php echo $vluchtnummer; ?></p>
            <p><strong>Geslacht:</strong> <?php echo $geslacht; ?></p>
            <p><strong>Balienummer:</strong> <?php echo $balienummer; ?></p>
            <p><strong>Stoel:</strong> <?php echo $stoel; ?></p>
            <p><strong>Inchecktijdstip:</strong> <?php echo $inchecktijdstip; ?></p>
            
        </div>
        <div class="col-2">
            <img src="../images/checkin.png" class="checkin">
            <div class="color-box"></div>
            <div class="add-btn"></div>
        </div>
    </div>
    <?php
}
?>