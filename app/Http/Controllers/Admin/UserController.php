<?php
/**
 * 前后台用户模块
 * @author ZENG
 * Date: 2017/7/10
 * Time: 11:24
 */
namespace App\Http\Controllers\Admin;
use App\Model\Admin\Admin;
use App\Model\inviteCode;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class UserController extends Controller
{

    public function __construct()
    {
        $this->adminLogin = new Logger('admin');
        $this->logRoute = env('ADMIN_LOG_ROUTE');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $userlist=User::paginate(15);
        return view('admin/user_manage',['title'=>'用户管理','navi'=>'user','user'=>$user,'userlist'=>$userlist]);
    }

    /**
     * 修改个人信息
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $name=$request->input('name');
        $email=$request->input('email');


        if($name==$user['name']&&$email!=$user['email']){
           $validator=\Validator::make($request->all(),[
               'email'=>'required|email'
           ],['email'=>':attribute 格式不对','required'=>':attribute 是必填项'],['email'=>'邮箱']);
            if($validator->fails()){
                $this->adminLogin->pushHandler(new StreamHandler($this->logRoute.'/Auth/Admin.log', Logger::ERROR));
                $this->adminLogin->addError('个人信息修改失败',array('message' => $validator->errors()->first(),'status' => 400));
                return $validator->errors()->first();
            }
            $user->email=$email;
        }elseif ($name!=$user['name']&&$email==$user['email']){
            $validator=\Validator::make($request->all(),[
                'name'=>'required|unique:admin'
            ],['required'=>':attribute 是必填项','unique'  =>'该:attribute已经存在'],['name'=>'用户名']);
            if($validator->fails()){
                $this->adminLogin->pushHandler(new StreamHandler($this->logRoute.'/Auth/Admin.log', Logger::ERROR));
                $this->adminLogin->addError('个人信息修改失败',array('message' => $validator->errors()->first(),'status' => 400));
                return $validator->errors()->first();
            }
            $user->name=$name;
        }elseif($name==$user['name']&&$email==$user['email']){
            return '1';
        } else{
            $validator = \Validator::make($request->all(), [
                'name' => 'required|unique:admin',
                'email' => 'required|email'
            ],
                [
                    'required' => ':attribute 是必填项',
                    'unique' => '该:attribute已经存在',
                    'email' => ':attribute 格式不对',

                ],
                [
                    'name' => '用户名',
                    'email' => '邮箱',
                ]
            );
            if ($validator->fails()) {
                $this->adminLogin->pushHandler(new StreamHandler($this->logRoute . '/Auth/Admin.log', Logger::ERROR));
                $this->adminLogin->addError('个人信息修改失败', array('message' => $validator->errors()->first(), 'status' => 400));
                return $validator->errors()->first();
            }
            $user->name=$name;
            $user->email=$email;
        }


        if($user->save()){
            Session::put('user',$request->input('name'));
            $this->adminLogin->pushHandler(new StreamHandler($this->logRoute.'/Auth/Admin.log', Logger::INFO));
            $this->adminLogin->addInfo('修改成功',array('message' => '个人信息修改成功','status' => 200));
            return '1';
        }


    }

    /**
     * 修改密码
     * @param Request $request
     */
    public function updatePwd(Request $request){
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $password=$request->input('oldpwd');
        if(md5($password)!=$user['password']){
            $this->adminLogin->pushHandler(new StreamHandler($this->logRoute.'/Auth/Admin.log', Logger::ERROR));
            $this->adminLogin->addError('密码修改失败',array('message' => '旧密码不正确','status' => 400));
            return '旧密码不正确';


        } elseif($password==$request->input('pwd')){
            $this->adminLogin->pushHandler(new StreamHandler($this->logRoute.'/Auth/Admin.log', Logger::ERROR));
            $this->adminLogin->addError('密码修改失败',array('message' => '新旧密码一样','status' => 400));
            return '新旧密码一样';

        }


        $validator = \Validator::make($request->all(), [
                'oldpwd'=>'required',
                'pwd'   =>'required',
                'newpwd'=>'required|same:pwd'],

            [
                'required' => ':attribute 是必填项',
                'same'    =>':attribute与新密码不一致'

            ],
            [

                'oldpwd'=>'旧密码',
                'pwd'   =>'新密码',
                'newpwd'=>'再次确认密码'
            ]
        );
        if ($validator->fails()) {
            $this->adminLogin->pushHandler(new StreamHandler($this->logRoute . '/Auth/Admin.log', Logger::ERROR));
            $this->adminLogin->addError('密码修改失败', array('message' => $validator->errors()->first(), 'status' => 400));
            return $validator->errors()->first();
        }
        $user->password=md5($request->input('pwd'));
        if($user->save()){
            $this->adminLogin->pushHandler(new StreamHandler($this->logRoute.'/Auth/Admin.log', Logger::INFO));
            $this->adminLogin->addInfo('密码修改成功',array('message' => '密码修改成功','status' => 200));
            return '1';
        }

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
        $user=User::find($id);

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
     * 修改用户全部信息
     * @param Request $request
     * @return string
     */
    public function updateUser(Request $request){
        $user=User::find($request->input('id'));
        if($user->phone!=$request->input('phone')&&$user->email==$request->input('email')){
            $validator = \Validator::make($request->all(), [
                'phone'=>'unique:user',
                ],

                [
                    'unique' => '该:attribute已经存在,请换别的手机号'
                ],
                [
                    'phone'=>'手机号',
                ]
            );
            if ($validator->fails()) {
                return $validator->errors()->first();
            }
        }elseif ($user->phone==$request->input('phone')&&$user->email!=$request->input('email')){
            $validator = \Validator::make($request->all(), [
                'email'=>'unique:user',
            ],

                [
                    'unique' => '该:attribute已经存在'
                ],
                [
                    'email'=>'邮箱',
                ]
            );
            if ($validator->fails()) {
                return $validator->errors()->first();
            }
        }elseif($user->phone!=$request->input('phone')&&$user->email!=$request->input('email')){
            $validator = \Validator::make($request->all(), [
                'email'=>'unique:user',
                'phone'=>'unique:user',
            ],

                [
                    'unique' => '该:attribute已经存在'
                ],
                [
                    'phone'=>'手机号',
                    'email'=>'邮箱'
                ]
            );
            if ($validator->fails()) {
                return $validator->errors()->first();
            }
        }
        if(!empty($request->input('username')))             $user->username=$request->input('username');
        if(!empty($request->input('phone')))                $user->phone=$request->input('phone');
        if(!empty($request->input('email')))                $user->email=$request->input('email');
                                                            $user->vip=$request->input('vip');
        if(!empty($request->input('restaurant_info')))      $user->restaurant_info=$request->input('restaurant_info');
        if(!empty($request->input('restaurant_name')))      $user->restaurant_name=$request->input('restaurant_name');
        if(!empty($request->input('restaurant_add')))       $user->restaurant_add=$request->input('restaurant_add');
        if(!empty($request->input('head')))                 $user->head=$request->input('head');
        if(!empty($request->input('invite_code')))          $user->invite_code=$request->input('invite_code');
        if(!empty($request->input('advance_deposit')))      $user->advance_deposit=$request->input('advance_deposit');
        if(!empty($request->input('business_license')))     $user->business_license=$request->input('business_license');
        if(!empty($request->input('password')))             $user->password=bcrypt($request->input('password'));
        if($user->save()){
            return '1';
        }else{
            return '修改失败';
        }

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

    /**
     *
     */
    public function adminUserList(){
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $userlist=Admin::paginate(15);
        return view('admin/adminlist',['title'=>'后台用户管理','navi'=>'admin','user'=>$user,'list'=>$userlist]);
    }

    /**
     * 删除后台管理员
     * @param $id
     */
    public function deleteAdminUser($id){
        $user=Admin::where(['name'=>Session::get('user')])->first();
        if($user['id']==$id){
            $user->delete();
            Session::forget('user');
            return redirect(url('/login'));
        }
        if(Admin::destroy($id)){
            $userlist=Admin::all();
        }
        return view('admin/adminlist',['title'=>'后台用户管理','navi'=>'admin','user'=>$user,'list'=>$userlist]);
    }

    /**
     * 添加管理员
     * @param Request $request
     */
    public function addUser(Request $request){
        $validator = \Validator::make($request->all(), [
            'name'=>'required|unique:admin',
            'email'=>'required|email',
            'password'   =>'required',
            'new_password'=>'required|same:password'],

            [
                'required' => ':attribute 是必填项',
                'same'    =>':attribute与新密码不一致',
                'unique' => '该:attribute已经存在'

            ],
            [

                'name'=>'用户名',
                'email'   =>'邮箱',
                'password'=>'密码',
                'new_password'=>'再次确认密码'
            ]
        );
        if ($validator->fails()) {
            $this->adminLogin->pushHandler(new StreamHandler($this->logRoute . '/Auth/Admin.log', Logger::ERROR));
            $this->adminLogin->addError('添加后台用户失败', array('message' => $validator->errors()->first(), 'status' => 400));
            return $validator->errors()->first();
        }
        $admin=new Admin();
        $admin->name        =$request->input('name');
        $admin->email       =$request->input('email');
        $admin->permissions =$request->input('permissions');
        $admin->password    =md5($request->input('password'));
        $admin->login_time  =time();
        if($admin->save()){
            return '1';
        }

    }

    /**
     * 查询后台用户信息
     * @param $id
     */
    public function findAdminInfo($id){
        $admin=Admin::find($id,['id','name','email','permissions']);//必须去除psswod等字段
        return $admin;
    }

    /**
     * 前台用户查找
     * @param $id
     */
    public function userInfoById($id){
        $user=User::find($id);
        unset($user['password']);
        return $user;
    }

    /**
     * 修改后台用户
     * @param Request $request
     */
    public function updateAdminUserInfo(Request $request){
        $id     =$request->input('id');
        $name   =$request->input('name');
        $email  =$request->input('email');
        $oldpwd =$request->input('oldpwd');
        $pwd    =$request->input('pwd');
        $new_pwd=$request->input('new_pwd');

        $admin=Admin::find($id);

        //密码不改
        if($oldpwd==''&&$pwd==''&&$new_pwd==''){
            //都没有改
            if($name==$admin['name']&& $email==$admin['email']){
                $admin->permissions=$request->input('permissions');
                if($admin->save()){
                    return '1';
                }

            }elseif ($name==$admin['name']&&$email!=$admin['email']){
                $admin->email=$email;

            } else{
                $validator = \Validator::make($request->all(), [
                    'name'=>'required|unique:admin',
                    'email'=>'required|email',
                    ],

                    [
                        'required' => ':attribute 是必填项',
                        'unique' => '该:attribute已经存在'

                    ],
                    [

                        'name'=>'用户名',
                        'email'   =>'邮箱'
                    ]
                );
                if ($validator->fails()) {
                    return $validator->errors()->first();
                }
                $admin->name=$name;
                $admin->email=$email;
            }

        }elseif ($oldpwd==''&&($pwd!=''||$new_pwd!='')){
            return '请输入旧密码';

        }elseif ($pwd!=$new_pwd){
            return '新密码与再次确认密码不一致';

        }elseif (md5($oldpwd)!=$admin['password']){
            return '旧密码不正确';

        }elseif ($oldpwd==$pwd){
            return '新旧密码一致';

        }else{
            if($name==$admin['name']){
                $validator = \Validator::make($request->all(), [
                    'email' => 'required|email',
                    'pwd' => 'required',
                    'new_pwd' => 'required|same:pwd'],

                    [
                        'required' => ':attribute 是必填项',
                        'same' => ':attribute与新密码不一致',
                        'unique' => '该:attribute已经存在'

                    ],
                    [
                        'email' => '邮箱',
                        'password' => '密码',
                        'new_password' => '再次确认密码'
                    ]
                );
                if ($validator->fails()) {
                    return $validator->errors()->first();
                }
                $admin->email=$email;
                $admin->password=md5($pwd);
            }else {
                        $validator = \Validator::make($request->all(), [
                            'name' => 'required|unique:admin',
                            'email' => 'required|email',
                            'pwd' => 'required',
                            'new_pwd' => 'required|same:pwd'],

                            [
                                'required' => ':attribute 是必填项',
                                'same' => ':attribute与新密码不一致',
                                'unique' => '该:attribute已经存在'

                            ],
                            [

                                'name' => '用户名',
                                'email' => '邮箱',
                                'password' => '密码',
                                'new_password' => '再次确认密码'
                            ]
                        );
                        if ($validator->fails()) {
                            return $validator->errors()->first();
                        }
                        $admin->name=$name;
                        $admin->email=$email;
                        $admin->password=md5($pwd);
                 }
        }
        $admin->permissions=$request->input('permissions');
        if($admin->save()){
            return '1';
        }
    }

}
