<?php
/**
 * 邀请码模块
 * @author ZENG
 * Date: 2017/7/10
 * Time: 11:24
 */
namespace App\Http\Controllers\Admin;
use App\Model\Admin\Admin;
use App\Model\Admin\Invite_code;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class InviteController extends Controller
{

    public function __construct()
    {
        $this->adminLogin = new Logger('admin');
        $this->logRoute = env('ADMIN_LOG_ROUTE');
    }
    /**
     * Display a listing of the resource.
     *  查看所有邀请码
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $code=DB::table('invite_code')
            ->join('admin', 'invite_code.aid', '=', 'admin.id')
            ->select(['invite_code.id','invite_code.status','invite_code.code','invite_code.created_at','invite_code.end_time','admin.name'])
            ->paginate(15);
        $count=Invite_code::count();
        return view('admin/invite_code',['title'=>'邀请码','navi'=>'code','user'=>$user,'invite'=>$code,'count'=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $num=$request->input('num');
        $day=$request->input('day');
        $date = date('Y-m-d', time());
        $time = strtotime($date)+60*60*24*$day;
        for($i=0;$i<$num;$i++){
            $inviteCode=new Invite_code();
            $code=rand('100','999').time().rand('100','999');
            $inviteCode->code=$code;
            $inviteCode->aid=$user['id'];
            $inviteCode->end_time=$time;
            $inviteCode->save();
        }
        return '1';

    }

    /**
     * 搜索邀请码
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selectCode(Request $request){
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $code=DB::table('invite_code')->join('admin', 'invite_code.aid', '=', 'admin.id')
                ->where(['invite_code.code'=>$request->input('code')])
                ->select(['invite_code.id','invite_code.status','invite_code.code','invite_code.created_at','invite_code.end_time','admin.name'])->get();
        $count=Invite_code::where(['code'=>$request->input('code')])->count();
        if($code){
           $code=$code->toArray();
        }
        return view('admin/invite_code',['title'=>'邀请码','navi'=>'code','user'=>$user,'invite'=>$code,'count'=>$count]);
    }
    /**
     * 邀请码已使用
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function haveUsedCode(){
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $code=DB::table('invite_code')
            ->join('admin', 'invite_code.aid', '=', 'admin.id')
            ->where(['invite_code.status'=>'2'])
            ->select(['invite_code.id','invite_code.status','invite_code.code','invite_code.created_at','invite_code.end_time','admin.name'])
            ->paginate(15);
        $count=Invite_code::where(['invite_code.status'=>'2'])->count();
        return view('admin/invite_code',['title'=>'邀请码','navi'=>'code','user'=>$user,'invite'=>$code,'count'=>$count]);

    }

    /**
     * 邀请码已过期
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function haveExpiredCode(){
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $code=DB::table('invite_code')
            ->join('admin', 'invite_code.aid', '=', 'admin.id')
            ->where('invite_code.end_time','<',time())
            ->select(['invite_code.id','invite_code.status','invite_code.code','invite_code.created_at','invite_code.end_time','admin.name'])
            ->paginate(15);
        $count=Invite_code::where('end_time','<',time())->count();
        return view('admin/invite_code',['title'=>'邀请码','navi'=>'code','user'=>$user,'invite'=>$code,'count'=>$count]);

    }

    /**
     * 未使用的邀请码
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unusedCode(){
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $code=DB::table('invite_code')
            ->join('admin', 'invite_code.aid', '=', 'admin.id')
            ->where('invite_code.end_time','>',time())
            ->where(['invite_code.status'=>'1'])
            ->select(['invite_code.id','invite_code.status','invite_code.code','invite_code.created_at','invite_code.end_time','admin.name'])
            ->paginate(15);
        $count=Invite_code::where('end_time','>',time())->where(['status'=>'1'])->count();
        return view('admin/invite_code',['title'=>'邀请码','navi'=>'code','user'=>$user,'invite'=>$code,'count'=>$count]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
