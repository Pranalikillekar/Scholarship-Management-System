<?php
include('includes/dbconnection.php');

if (isset($_POST['applicationNumber']) && isset($_POST['status'])) {
    $applicationNumber = $_POST['applicationNumber'];
    $status = $_POST['status'];
    $sql = "UPDATE apply SET Status = :status WHERE ApplicationNumber = :applicationNumber";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':applicationNumber', $applicationNumber, PDO::PARAM_STR);
    if ($query->execute()) {
        echo "Application status updated to $status.";
    } else {
        echo "Failed to update the application status.";
    }
}
?>
