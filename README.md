# SteamCasebot
Keep a hourly track on case prices directly on your discord server!<br>
A Steam case bot (CS:GO Cases) with integrated Discord support.

# About
Started collecting and selling cases for CS:GO on steam, I needed a quick way to get the prices of the boxes I collected every hour on Discord, threw together this unfinished but flawlessly working 'thing', I haven't added support for knives or other valued skins yet, might to if someone if interested!
![image](https://user-images.githubusercontent.com/20803604/203655421-8b66b9b4-a258-4210-9662-6da199316dbb.png)
![image](https://user-images.githubusercontent.com/20803604/203658040-5834130a-c28d-448b-b4b1-1f61f9183433.png)<br>
![image](https://user-images.githubusercontent.com/20803604/203655695-18e28d5e-19d2-42e5-8df2-094c9fd6d559.png)
<br>(Fictitious domain)




# Installation
* Start by fetching the files and upload them to your webbserver
* Import the included dbt.sql-file
* Configure: cfg.php and embed.php

Either run embed.php via conjob or by pinging the script
* 0 * * * * php -e /var/www/html/PATH/embed.php
(hourly)

# Reach me
Crille#6623


# Discord Auth
Credits to MarkisDev for his Discord Auth library
