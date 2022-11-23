<?php
include_once("cfg.php");


if (isset($_POST['add_case'])) {
    session_start();
    extract($_POST);
    // $sql=mysqli_query($con,"SELECT * FROM lager");
    $dcwebhook = $_POST['dcwebhook'];
    $steamvalue = $_POST['steamvalue'];
    $custom_text = htmlspecialchars($_POST['custom_text']);
    $ids = $_SESSION['g_id'];
    $image_lnk = $_SESSION['g_img'];
    $item_name = $_SESSION['g_item'];
    $item_url = $_SESSION['g_url'];
    $username = $_SESSION['user_id'];
    echo $dcwebhook;
    echo $steamvalue . '<br>';
    echo $ids;
    mysqli_set_charset($con, "utf8");
    mysqli_real_escape_string($con, $query);
    $query="INSERT INTO `bots` (`id`, `name`, `custom_name`, `enabled`, `lang`, `username`, `url`, `webhook`, `lowest`, `median_price`, `img`) VALUES (NULL, '{$item_name}', '{$custom_text}', '1', 'us', '{$username}', '{$item_url}', '{$dcwebhook}', '{$steamvalue}€', 'mtest', '{$image_lnk}');";
    $sql=mysqli_query($con,$query)or die(header ("Location: add.php?status=fail"));
    header ("Location: profile.php?status=complete");
}
?>