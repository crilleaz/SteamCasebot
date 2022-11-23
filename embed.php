<?php
include_once("cfg.php");

$sql = "SELECT * FROM bots"; 
    $result = $con->query($sql);
    while($row = mysqli_fetch_array($result))
    {
        $username = $row["username"];
        $webhook = $row["webhook"];
        $steam_url = $row["url"];
        $lowest_value_to_send_message = $row["lowest"];
        $language = $row["lang"];
        $enabled = $row["enabled"];
        $item_name = $row["name"];
        $item_img = $row["img"];
        $url = $row["url"];
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);
        $lowest = $json_data["lowest_price"];
        $volume = $json_data["volume"];
        $median_price = $json_data["median_price"];
        
        $msg = "";
        if($enabled > "0"){
            if($lowest >= $row["lowest"]){
                    if($language == "swe"){
                        $msg = 'Priset just nu för ' . $item_name . ': ' . $lowest;
                    }elseif($language == "us"){
                        $msg = 'Price right now for ' . $item_name . ': ' . $lowest;
                    }else{
                        $msg = 'Price right now for ' . $item_name . ': ' . $lowest;
                    }
                    $msg = $msg;
                    $url = $row["webhook"];
                    $webhookurl = "$url";
                    $timestamp = date("c", strtotime("now"));
                    $json_data = json_encode([
                        "username" => "SteamBot.se",
                        "avatar_url" => "http://YOUR_URL/steambot/avatar.jpg",
                        "tts" => false,
                        "embeds" => [
                            [
                                "title" => "$item_name",
                                "type" => "rich",
                                "description" => "$msg",
                                "url" => "https://YOUR_URL",
                                "timestamp" => $timestamp,
                                "color" => hexdec( "3366ff" ),

                                // fötter
                                "footer" => [
                                    "text" => "by SteamBot.se",
                                    "icon_url" => "http://YOUR_URL/steambot/avatar.jpg"
                                ],
                            ]
                        ]

                    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

                    $ch = curl_init( $webhookurl );
                    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
                    curl_setopt( $ch, CURLOPT_POST, 1);
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
                    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt( $ch, CURLOPT_HEADER, 0);
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
                    $response = curl_exec( $ch );
                    // echo $response;
                    curl_close( $ch );
        }
    }
}