<?php

/**
 * 微信支付 （支付,查询,退款）
 * @author ZENG
 * Date: 17-7-19
 * Time: 上午10:12
 */
namespace Wechat;
use Lib\Wechat;
use WechatPay\Lib\WechatPayOrderQuery;
use WechatPay\Lib\WechatPayRefund;
use WechatPay\WechatPayApi;
use WechatPay\Lib\WechatPayUnifiedOrder;

class WechatPay
{
    /**
     * 微信公众号下单支付JSAPI
     * @param $title        商品标题
     * @param $description  商品描述
     * @param $price        商品价格
     * @return array        返回用于页面js验证的数组
     */
    public function payForOrder($title,$description,$price){
        $wechat=new Wechat();
        $data=$wechat->getOauthAccessToken();
        $openId=$data['openid'];

        //进行公众号支付

        $input=new WechatPayUnifiedOrder();
        $input->SetBody($title);
        $input->SetAttach($description);                                    //描述
        $input->SetOut_trade_no(env('MCHID').date("YmdHis"));               //自己产品的订单号
        $input->SetTotal_fee($price*100);                                   //价格
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url(env('WECHAT_PAY_CALLBACK'));                   //支付回调地址，异步通知
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WechatPayApi::unifiedOrder($input);
        $jsApiParameters=json_decode(WechatPayApi::GetJsApiParameters($order),true);
        return ['jsApiParameters'=>$jsApiParameters];

    }

    /**
     * @param $order
     *     格式为$order=['transaction_id'=>'商品订单号];
     *           或
     *          $order=['out_trade_no'=>‘商家订单号’];
     * @return \WechatPay\成功时返回
     */
    public function orderQuery($order){
        if(isset($order["transaction_id"]) && $order["transaction_id"] != ""){
            $transaction_id = $order["transaction_id"];
            $input = new WechatPayOrderQuery();
            $input->SetTransaction_id($transaction_id);
            $payInfo=WechatPayApi::orderQuery($input);

        }

        if(isset($order["out_trade_no"]) && $order["out_trade_no"] != ""){
            $out_trade_no = $order["out_trade_no"];
            $input = new WechatPayOrderQuery();
            $input->SetOut_trade_no($out_trade_no);
            $payInfo=WechatPayApi::orderQuery($input);

        }
        return json_encode($payInfo);
    }

    /**
     *
     * @param $order
     *          格式为$order=['transaction_id'=>'商品订单号'，
     *                      ‘total_fee’=>'总价'，
     *                      ‘refund_free’=>'退款价格‘]
     *              或
     *              $order=['out_trade_no'=>'商家订单号'，
     *                      ‘total_fee’=>'总价'，
     *                      ‘refund_free’=>'退款价格‘]
     * @return string
     */
    public function orderRefund($order){
        if(isset($order["transaction_id"]) && $order["transaction_id"] != ""){
            $transaction_id = $order["transaction_id"];
            $total_fee = $order["total_fee"]*100;
            $refund_fee = $order["refund_fee"]*100;
            $input = new WechatPayRefund();
            $input->SetTransaction_id($transaction_id);
            $input->SetTotal_fee($total_fee);
            $input->SetRefund_fee($refund_fee);
            $input->SetOut_refund_no(env('MCHID').date("YmdHis"));
            $input->SetOp_user_id(env('MCHID'));
            $refundInfo=WechatPayApi::refund($input);
        }

        if(isset($order["out_trade_no"]) && $order["out_trade_no"] != ""){
            $out_trade_no = $order["out_trade_no"];
            $total_fee = $order["total_fee"]*100;
            $refund_fee = $order["refund_fee"]*100;
            $input = new WechatPayRefund();
            $input->SetOut_trade_no($out_trade_no);
            $input->SetTotal_fee($total_fee);
            $input->SetRefund_fee($refund_fee);
            $input->SetOut_refund_no(env('MCHID').date("YmdHis"));
            $input->SetOp_user_id(env('MCHID'));
            $refundInfo=WechatPayApi::refund($input);
        }
        return json_encode($refundInfo);
    }


}