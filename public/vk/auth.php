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
use VK\OAuth\VKOAuthResponseType;
use VK\OAuth\Scopes\VKOAuthUserScope;

$oauth = new VKOAuth();
$client_id = 6611942;
$client_secret = 'MtDY9CwA3ou9dNTrYc6I';
$code = 'CODE';
$redirect_uri = 'http://192.168.33.11/vk';;
$display = VKOAuthDisplay::PAGE;
#https://vk.com/dev/permissions VKOAuthGroupScope::MESSAGES, VKOAuthGroupScope::PHOTOS, VKOAuthGroupScope::MANAGE,
//$scope = array( VKOAuthGroupScope::PHOTOS, VKOAuthGroupScope::MANAGE, VKOAuthUserScope::GROUPS, VKOAuthUserScope::WALL, VKOAuthUserScope::OFFLINE );
$scope = array( VKOAuthUserScope::GROUPS, VKOAuthUserScope::WALL, VKOAuthUserScope::OFFLINE, VKOAuthUserScope::AUDIO );
$state = 'secret_state_code';
$groups_ids = array('167312918');

$browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::CODE, $client_id, $redirect_uri, $display, $scope, $state);

if(!empty($browser_url)){
    header( 'Location: '.$browser_url );
}
