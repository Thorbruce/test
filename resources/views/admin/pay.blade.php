<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微信公众号支付demo</title>

    <script>
        function onBridgeReady(){
            WeixinJSBridge.invoke(
                    'getBrandWCPayRequest', {
                        "appId":"{{$pay['appId']}}",     //公众号名称，由商户传入
                        "timeStamp":'{{$pay["timeStamp"]}}',         //时间戳，自1970年以来的秒数
                        "nonceStr":'{{$pay["nonceStr"]}}', //随机串
                        "package":'{{$pay["package"]}}',
                        "signType":'{{$pay["signType"]}}',         //微信签名方式：
                        "paySign":'{{$pay["paySign"]}}' //微信签名
                    },
                    function(res){
                        WeixinJSBridge.log(res.err_msg);
//                        alert(res.err_code+res.err_desc+res.err_msg);   //调试
                        if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                            //成功后的跳转
                            window.location.href='http://www.baidu.com';
                        }     // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
                    }
            );
        }
        //判断是不是微信浏览器
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
            }
        }else{
            //执行上面支付的方法，通过js调用
            onBridgeReady();
        }
    </script>
</head>
<body>
</body>
</html>