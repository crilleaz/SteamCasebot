# SteamCasebot
Keep a hourly track on case prices directly on your discord server!
A CS:GO case bot with integrated Discord support.

# About
![image](https://user-images.githubusercontent.com/20803604/203655421-8b66b9b4-a258-4210-9662-6da199316dbb.png)
![image](https://user-images.githubusercontent.com/20803604/203655695-18e28d5e-19d2-42e5-8df2-094c9fd6d559.png)





# Installation
* Start by fetching the files and upload them to your webbserver
* Import the included database.sql-file
* Configure: cfg.php and embed.php

Either run embed.php via conjob or by pinging the script
* 0 * * * * php -e /var/www/html/PATH/embed.php
(hourly)


# Discord Auth
Credits to MarkisDev for his Discord Auth library
