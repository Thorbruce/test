<?php
/**
 * Created by PhpStorm.
 * User: ct
 * Date: 2017/7/6
 * Time: 9:32
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Session;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Http\Request;
use App\Model\Admin\Admin;

class AdminController extends BaseController
{
    private $logRoute;
    private $adminLogin;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->adminLogin = new Logger('adminLogin');
        $this->logRoute = env('ADMIN_LOG_ROUTE');
    }

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {
        $name = $request->input('name');
        $password = md5($request->input('password'));
        $admin = Admin::where(['name' => $name,'password' => $password])->first();

        if(empty($admin)){

            $this->adminLogin->pushHandler(new StreamHandler($this->logRoute.'/Auth/login.log', Logger::ERROR));
            $this->adminLogin->addError('账号或密码错误',array('name' => $name,'status' => 400));

            echo '0';

        }else{
            $admin->ip=$request->getClientIp();
            $admin->login_time=time();
            $admin->save();

            $this->adminLogin->pushHandler(new StreamHandler($this->logRoute.'/Auth/login.log', Logger::INFO));
            $this->adminLogin->addInfo('登陆成功',array('name' => $name,'status' => 200));
            $request->session()->put('user', $name);

            echo '1';
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 退出登录
     */
    public function logout(Request $request){

        $this->adminLogin->pushHandler(new StreamHandler($this->logRoute.'/Auth/logout.log', Logger::INFO));
        $this->adminLogin->addInfo('退出登录',array('name' => $request->session()->get('user'),'status' => 200));

        $request->session()->forget('user');
        return redirect(url('/login'));
    }
    public function index(){
        $session=Session::get('user');
        $User=Admin::where(['name'=>$session])->first();
        $admin=Admin::count();
        $system=$this->os();
        return view('admin/index',['user'=>$User,'title'=>'首页','navi'=>'index','count'=>$admin,'sys'=>$system]);
    }
    private     function os(){
        $os = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/NT\s5\.1/',$os)){
            $os = "Windows XP";
        }elseif(preg_match('/NT\s6\.0/',$os)){
            $os =  "Windows Vista \ server 2008";
        }elseif(preg_match('/NT\s5\.2/',$os)){
            $os = "Windows Server 2003";
        }elseif(preg_match('/NT\s5/',$os)){
            $os = "Windows 2000";
        }elseif(preg_match('/NT/',$os)){
            $os ="Windows NT";
        }elseif(preg_match('/NT\s6\.1/',$os)){
            $os = "Windows 7";
        }elseif(preg_match('/Linux/',$os)){
            $os ="Linux";
        }elseif(preg_match('/Unix/',$os)){
            $os = "Unix";
        }elseif(preg_match('/Mac/',$os)){
            $os = "Macintosh";
        }elseif(preg_match('/NT\s6\.1/',$os)){
            $os ="Windows 7";
        }
        else $os ="Unknow OS";
        return $os;
    }
}