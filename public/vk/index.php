<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 20.06.18
 * Time: 18:01
 */

require_once __DIR__."/../../vendor/autoload.php";

use VK\Client\Enums\VKLanguage;
use VK\Client\VKApiClient;
use VK\OAuth\Scopes\VKOAuthGroupScope;
use VK\OAuth\VKOAuth;
use VK\OAuth\VKOAuthDisplay;

$vk = new VKApiClient();
$oauth = new VKOAuth();
$client_id = 6611942;
$client_secret = 'MtDY9CwA3ou9dNTrYc6I';
$code = $_GET['code'];
$redirect_uri = 'http://192.168.33.11/vk';

//$curl = new CurlHttpClient(10);
session_start();


$response = $oauth->getAccessToken($client_id, $client_secret, $redirect_uri, $code);




//$vk->wall()->post($accessToken, ['message' => "hello world"]);
//
echo __FILE__."<hr /><pre>";
print_r($response);
//die();


//$response = $vk->wall()->post($accessToken,
//    [
//        'owner_id' => '-167312918',
//        'from_group' => 1,
//        'message' => "HELLO WORLD API TEST",
//    ]
//);
////
////
//////$response = $vk->wall()->get($accessToken, ['owner_id' => '-167312918', 'count' => 1]);
//echo __FILE__."<hr /><pre>";
//print_r($response);
//die();
?>






