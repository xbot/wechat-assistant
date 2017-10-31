<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('/wechat/serve', 'App\Api\V1\Controllers\WechatController@checkSrv');
    // $api->post('/wechat/serve', 'App\Api\V1\Controllers\WechatController@serve');
});
