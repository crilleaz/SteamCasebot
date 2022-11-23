<?php
include_once("cfg.php");



if (isset($_POST['remove'])) {
    session_start();
    extract($_POST);
    $ree = $_POST['ree'];
    $r_id = $_SESSION['r_id'];
    $username = $_SESSION['user_id'];
    echo 'hejhej';
    echo $steamvalue . '<br>';
    echo $r_id;
    mysqli_set_charset($con, "utf8");
    mysqli_real_escape_string($con, $query);
    $query="DELETE FROM bots WHERE id = {$r_id} AND username = {$username};";
    $sql=mysqli_query($con,$query)or die(header ("Location: add.php?status=fail"));
    header ("Location: profile.php?status=complete");
}
?>