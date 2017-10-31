<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WechatController extends BaseController
{

    /**
     * 对接校验接口
     *
     * @return void
     */
    public function checkSrv(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'signature' => 'required|string',
            'timestamp' => 'required|string',
            'nonce'     => 'required|string',
            'echostr'   => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->response->error($validator->errors()->first(), 422);
        }

        $tmp = [config('wechat.token'), $request->get('timestamp'), $request->get('nonce')];
        sort($tmp, SORT_STRING);

        if (sha1(implode($tmp)) == $request->get('signature')) {
            return $request->get('echostr');
        } else {
            return $this->response->error('Invalid signature.', 422);
        }
    }

}
