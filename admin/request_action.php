<?php
require_once __DIR__ . "/_auth.php";
require_once "../db/connection.php";

$id = $_GET["id"];
$action = $_GET["action"];

if ($action == "approve") {

    mysqli_query($conn, "UPDATE hospital_requests 
        SET status='Approved', fulfilled_date=CURDATE() 
        WHERE hospital_id=$id");

} elseif ($action == "reject") {

    mysqli_query($conn, "UPDATE hospital_requests 
        SET status='Rejected' 
        WHERE hospital_id=$id");

} elseif ($action == "delete") {

    mysqli_query($conn, "DELETE FROM hospital_requests WHERE hospital_id=$id");
}

header("Location: requests.php");
exit;
?>
