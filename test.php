<?php include('./connections/connection.php') ?>
<?php include('./connections/global.php') ?>
<?php include('./connections/functions.php') ?>

<?php
$req_id = 1;
$get_amonut_wallet = mysqli_query($conn, "SELECT * FROM `wallet` WHERE `user_id` = '$req_id'");
while ($row = mysqli_fetch_array($get_amonut_wallet)) {
    echo $wallet_amount = $row['amount'];
}
