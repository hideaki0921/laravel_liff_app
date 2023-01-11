<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;

require_once __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// $httpClient = new CurlHTTPClient('LszLCMbYa6juKtEH+sWiVsdVi8gHfkPQrAvvBBrjGfWcNxGWSdL81+YD/zYwmr+Y9mDrbhfzUf/LsiAiKVnhxPvV84wGxnX1i0S4Ed+rddSkc5FrU3SjFhtwDw4pqRoEyDL1nywkN/96rLkxk895pAdB04t89/1O/w1cDnyilFU=');
// $bot = new LINEBot($httpClient, ['channelSecret' => 'f6cc65a1a31308bce64eaab70c6e8ba9']);

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('LszLCMbYa6juKtEH+sWiVsdVi8gHfkPQrAvvBBrjGfWcNxGWSdL81+YD/zYwmr+Y9mDrbhfzUf/LsiAiKVnhxPvV84wGxnX1i0S4Ed+rddSkc5FrU3SjFhtwDw4pqRoEyDL1nywkN/96rLkxk895pAdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'f6cc65a1a31308bce64eaab70c6e8ba9']);

Route::post('/webhook', function (Request $request) use ($bot) {
    $request->collect('events')->each(function ($event) use ($bot) {
        $bot->replyText($event['replyToken'], $event['message']['text']);
    });
    return 'ok!';
});
