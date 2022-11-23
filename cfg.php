<?php
$con = mysqli_connect('xx.yy.xx.yy.xx', 'xxxxxx', 'yyyyyy', 'dbt');
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


# CLIENT ID
# https://i.imgur.com/GHI2ts5.png (screenshot)
$client_id = "BOT_CLIENT_ID";

# CLIENT SECRET
# https://i.imgur.com/r5dYANR.png (screenshot)
$secret_id = "BOT_SECRET_ID";

# SCOPES SEPARATED BY SPACE
# example: identify email guilds connections  
$scopes = "identify";

# REDIRECT URL
# example: https://mydomain.com/includes/login.php
# example: https://mydomain.com/test/includes/login.php
# /steambot = path
$redirect_url = "http://YOUR_URL/steambot/login.php";

# IMPORTANT READ THIS:
# - Set the `$bot_token` to your bot token if you want to use guilds.join scope to add a member to your server
# - Check login.php for more detailed info on this.
# - Leave it as it is if you do not want to use 'guilds.join' scope.

# https://i.imgur.com/2tlOI4t.png (screenshot)
$bot_token = null;

?>