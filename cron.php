<?php
require_once __DIR__."./MVC/Controller/APIRoom.php";
$apiRoom = new APIRoom();
$apiRoom->cronSetOnlineRoom();
$apiRoom->cronSetOfflineRoom();

