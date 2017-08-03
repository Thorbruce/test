<?php
/**
 * 测试方法
 * @author ZENG
 * Date: 2017/7/10
 * Time: 11:24
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lib\Wechat;
use Wechat\WechatPay;

class TestController extends Controller
{
    //
    public function toLogin()
    {
        return view('admin/login');
    }
    //后台首页
    public function index()
    {
        return view('admin/index',['title'=>'首页','navi'=>'index']);
    }
    //添加文章
    public function addArticle()
    {
        return view('admin/add_article',['title'=>'添加文章','navi'=>'article']);
    }
    //修改文章
    public function updateArticel(){
        return view('admin/update_article',['title'=>'修改文章','navi'=>'article']);
    }
    //文章列表
    public function articleManage()
    {
        return view('admin/article',['title'=>'文章管理','navi'=>'article']);
    }
    //添加友情链接
    public function addFlink()
    {
        return view('admin/add_flink',['title'=>'添加友情链接','navi'=>'other']);
    }
    //友情链接列表
    public function flinkManage()
    {
        return view('admin/flink',['title'=>'友情链接管理','navi'=>'other']);
    }
    //友情链接修改
    public function upadteFlink(){
        return view('admin/update_flink',['title'=>'友情链接修改','navi'=>'other']);
    }
    //访问记录
    public function loginHistoryLogList()
    {
        return view('admin/loginlog',['title'=>'访客记录','navi'=>'other']);
    }
    //分类
    public function categoryManage()
    {
        return view('admin/category',['title'=>'栏目管理','navi'=>'category']);
    }
    //分类修改
    public function updateCategory(){
        $user=Admin::where(['name'=>Session::get('user')])->first();
//        print_r($user);die;
        return view('admin/update_category',['title'=>'栏目修改','navi'=>'category','user'=>$user]);
    }
    //设置
    public function setting()
    {
        return view('admin/setting',['title'=>'基本设置','navi'=>'set']);
    }
    //头部设置
    public function headerSet()
    {

        return view('admin/readset',['title'=>'阅读设置','navi'=>'set']);
    }
    //用户管理
    public function userManage()
    {
        return view('admin/user_manage',['title'=>'用户管理','navi'=>'user']);
    }
    //评论
    public function commentManage()
    {
        return view('admin/comment',['title'=>'评论管理','navi'=>'comment']);
    }
    //通告管理
    public function noticeManage()
    {
        return view('admin/notice',['title'=>'通告管理','navi'=>'notice']);
    }
    //添加通告
    public function addNotice()
    {
        return view('admin/add_notice',['title'=>'添加通告','navi'=>'notice']);
    }
    //公众号h5支付
    public function pay(Request $request){
        $wechatpay=new WechatPay();
        $paydata=$wechatpay->payForOrder('测试','测试订单','0.01');
        return view('admin/pay',['pay'=>$paydata['jsApiParameters']]);
    }
    //查询
    public function query(){
        $data=['out_trade_no'=>'132472850120170720102651'];
        $wechatpay=new WechatPay();
        print_r($wechatpay->orderQuery($data));
    }
    //退款
    public function refund(){
        $data=['transaction_id'=>'4009102001201707201692433366',
                'total_fee'=>'1',
                'refund_fee'=>'1'];
        $wechatpay=new WechatPay();
        print_r($wechatpay->orderRefund($data));
    }
    public function testabc(){
//        $content='<div style="text-align: center"><h1>司机送货指南</h1></div>';
//        file_put_contents('doc/abc'.time().'.docx',$content);
       $a= file_get_contents('doc/abc1500539325.docx');
        echo $a;
    }
}
