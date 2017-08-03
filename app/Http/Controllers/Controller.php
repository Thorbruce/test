<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;



class Controller extends BaseController
{
    /**
     * @param $code
     * @param $msg
     * @param $data
     * @return array
     * http响应
     */
    protected function MyResponse($code,$msg,$data)
    {
        $arr = json_encode(['status' => \response()->json()->status(),'code' => $code,'msg' => $msg,'data' => $data]);

        return $arr;
    }
}
