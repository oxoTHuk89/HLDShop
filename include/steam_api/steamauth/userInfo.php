<?php
	include("settings.php");
    if (empty($_SESSION['steam_uptodate']) or $_SESSION['steam_uptodate'] == false or empty($_SESSION['steam_personaname'])) {
        $url = file_get_contents(
            "http://api.steampowered.com/
            ISteamUser/
            GetPlayerSummaries/
            v0002/
            ?key=".$steamauth['apikey']."&steamids=".$_SESSION['steamid']);
        $content = json_decode($url, true);
        $_SESSION['steam_steamid'] = $content['response']['players'][0]['steamid'];
            }
    
    $steamprofile['steamid'] = $_SESSION['steam_steamid'];

?>

//http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key="6FC618E6E3C51B849FEF8CB8C121FBDD"&steamids=76561197977933798