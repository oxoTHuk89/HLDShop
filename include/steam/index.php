<?php
error_reporting(E_ERROR | E_PARSE | E_WARNING);

$user = new user;
$user->apikey = "6FC618E6E3C51B849FEF8CB8C121FBDD"; // put your API key here
$user->domain = "http://g-nation.ru/shop_test/include/steam/index.php"; // put your domain


class user
{
    public static $apikey;
    public static $domain;

    public function GetPlayerSummaries ($steamid)
    {
        $response = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->apikey . '&steamids=' . $steamid);
		var_dump($response);
        $json = json_decode($response);
        return $json->response->players[0];
    }

    public function signIn ()
    {
		var_dump($steamid);
        require_once 'openid.php';
        $openid = new LightOpenID($this->domain);// put your domain
        if(!$openid->mode)
        {
			var_dump($steamid);
            $openid->identity = 'http://steamcommunity.com/openid';
            header('Location: ' . $openid->authUrl());
        }
        elseif($openid->mode == 'cancel')
        {
			var_dump($steamid);
            print ('User has canceled authentication!');
        }
        else
        {
            if($openid->validate())
            {
				var_dump($steamid);
                preg_match("/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/", $openid->identity, $matches); // steamID: $matches[1]
                setcookie('steamID', $matches[1], time()+(60*60*24*7), '/'); // 1 week
                header('Location: /');
                exit;
            }
            else
            {
                print ('fail');
            }
        }
    }
}

if(isset($_GET['login']))
{
	//die(var_dump($user));
    $user->signIn();
}
if (array_key_exists( 'logout', $_POST ))
{
    setcookie('steamID', '', -1, '/');
    header('Location: /');
}


if(!$_COOKIE['steamID'])
{
    print ('<form action="?login" method="post">
        <input type="image" src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_large_border.png"/>
        </form>');
}
else
{
    print('<form method="post"><button title="Logout" name="logout">Logout</button></form>');
    echo $user->GetPlayerSummaries($_COOKIE['steamID'])->steamid;
	//var_dump($_COOKIE);
}