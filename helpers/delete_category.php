<?php
include("../connections/connection.php");
include("../connections/global.php");
include("../connections/functions.php");
$req_id = $_GET['req_id'];

$delete = mysqli_query($conn, "DELETE FROM `categories` WHERE id = '$req_id'");
if ($delete) {
    Toast('success', 'Deleted Successfully ...');
    echo "<meta http-equiv=\"refresh\" content=\"2; url=./view_categories.php\">";
} else {
    Toast('', 'Deleted Successfully ...');
}
