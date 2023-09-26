<?php
include("../connections/connection.php");
include("../connections/global.php");
include("../connections/functions.php");
$get_cat_id = $_GET['category_id'];
if ($get_cat_id != "") {
    echo '
<option value=""></option>
';
    $get_categories = mysqli_query($conn, "SELECT * FROM `package` WHERE `category_id` = '$get_cat_id'");
    while ($rows = mysqli_fetch_array($get_categories)) {
        $package_name = $rows["package_name"];
        $package_description = $rows["package_description"];
        echo '
        <option value="' . $package_name . '">' . $package_name . '||' . $package_description . '</option>
        ';
    }
}
