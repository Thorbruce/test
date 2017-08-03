<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 接口路由
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1',function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('user/login/email', 'AuthController@authenticateEmail');
        $api->post('user/login/phone', 'AuthController@authenticatePhone');
        $api->post('auth/send/msg', 'AuthController@sendCode');
        $api->post('auth/reg', 'AuthController@reg');

        $api->post('auth/test', 'AuthController@authenticateFast');//永久性测试路由请勿删除 项目结束后一并删除

        $api->group(['middleware' => 'jwt.auth'], function ($api) {
            $api->get('user/info', 'AuthController@getAuthenticatedUser');
            $api->post('user/reset_password', 'AuthController@userUpdatePass');
        });
        $api->group(['middleware' => 'jwt.refresh'], function ($api) {
            $api->get('refresh/token', 'AuthController@refreshToken');
        });

        /**
         * 找回密码
         */
        $api->post('user/retrieve_pass', 'RetrievePasswordController@sendRetrievePassEmail');
        $api->post('user/verify_pass', 'RetrievePasswordController@verifyUpdate');
    });
});
/**
 * 管理后台路由
 */

Route::group(['namespace' => '\Admin'],function () {
    Route::get('/a', 'TestController@pay');                                             //支付下单
    Route::get('/query', 'TestController@query');                                       //支付订单查询
    Route::get('/refund', 'TestController@refund');
    Route::get('ab','TestController@testabc');
    Route::post('/uploadimage','CategoryController@uploadImage');
    Route::get('/login', 'TestController@toLogin');
    Route::post('/admin/login', 'AdminController@login');                               //登录框
    Route::group(['middleware' => 'admin.login'],function(){
        Route::get('/logout', 'AdminController@logout');                                //退出登录
        Route::post('pwd','UserController@updatePwd');                                  //密码修改
        Route::get('/admin/index', 'AdminController@index');                            //主页
        //后台用户管理
        Route::resource('user','UserController');                                       //后台用户处理
        Route::get('/admin/userlist', 'UserController@adminUserList');                  //用户管理
        Route::get('/admin/delete/{id}', 'UserController@deleteAdminUser');             //删除后台用户
        Route::post('/admin/add','UserController@addUser');                             //后台添加用户
        Route::get('admin/find/{id}','UserController@findAdminInfo');                   //查找后台用户
        Route::post('/admin/update','UserController@updateAdminUserInfo');              //后台修改用户

        //前台用户
        Route::get('user/find/{id}','UserController@userInfoById');
        Route::post('user/update','UserController@updateUser');
        //分类
        Route::resource('cate','CategoryController');
        Route::get('cate/delete/{id}','CategoryController@delete');
        Route::post('/uploadimage','CategoryController@uploadImage');
        Route::post('/update/{id}','CategoryController@updateCatefory');

        //邀请码
        Route::resource('invite','InviteController');
        Route::get('/used','InviteController@haveUsedCode');
        Route::get('/expired','InviteController@haveExpiredCode');
        Route::get('/unused','InviteController@unusedCode');
        Route::post('select','InviteController@selectCode');

        //产品
        Route::resource('product','GoodController');
        Route::post('batch','GoodController@batchDelete');
        Route::post('/add/product','GoodController@addProduct');
        Route::get('product/delete/{id}','GoodController@delete');
        Route::get('/cateselect/{cateid}','GoodController@indexBySelect');
        Route::get('/product/select/{name}','GoodController@indexSelectByName');
        //充值
        Route::get('/recharge','RechargeController@index');
        Route::get('/recharge/search','RechargeController@search');


        //订单
        Route::resource('orderlist','OrderController');
        Route::post('order/delete','OrderController@deleteAll');
        Route::get('order/delete/{id}','OrderController@delete');
        Route::get('order/query','OrderController@select');
        Route::get('test','OrderController@test');
        Route::get('orderlist/export/{date}','OrderController@export');

        Route::get('/flink', 'TestController@FlinkManage');                            //友情链接列表
        Route::get('/addflink', 'TestController@addFlink');                            //添加友情链接
        Route::get('/loginlist', 'TestController@loginHistoryLogList');                //登录记录
        Route::get('/category', 'TestController@categoryManage');                      //分类列表
        Route::get('/set', 'TestController@setting');                                  //后台设置
        Route::get('/readset', 'TestController@headerSet');                            //后台设置

        Route::get('/comment', 'TestController@commentManage');                        //评论管理
        Route::get('/notice', 'TestController@noticeManage');                          //评论管理
        Route::get('/addnotice', 'TestController@addNotice');                          //添加公告
        Route::get('/upadtecategory', 'TestController@updateCategory');                //分类修改
        Route::get('/upadteflink', 'TestController@upadteFlink');                      //友情链接修改
    });
});

/**
 * 前台路由
 */
Route::group(['namespace' => '\Index'],function () {
    Route::get('/assistant/login', 'UserController@login');
    Route::get('/assistant/getAddress', 'UserController@getAddress');
    Route::get('/assistant/reg', 'UserController@reg');
    Route::get('/assistant/reset', 'UserController@resetPassword');
    Route::get('/assistant/fasterLogin', 'UserController@fasterLogin');
    Route::post('/assistant/userLogin', 'UserController@userLogin');
    Route::post('/assistant/userFastLogin', 'UserController@fastLogin');
    Route::post('/assistant/updatePass', 'UserController@userUpdatePass');
    Route::group(['middleware' => 'user.login'],function(){
        Route::get('/assistant/index', 'UserController@index');


        /**
         * 个人中心业务
         */
        Route::get('/assistant/my', 'UserController@my');
        Route::get('/assistant/myMoney', 'UserController@myMoney');
        Route::get('/assistant/topUp', 'UserController@topUp');
        Route::get('/assistant/myInfo', 'UserController@myInfo');
        Route::get('/assistant/address', 'UserController@userAddress');
        Route::get('/assistant/addAddress', 'UserController@addAddress');
        Route::get('/assistant/getAddress/{id}','UserController@getAddress')->where('id', '[0-9]+');
        Route::get('/assistant/getAddressIndex/{id}','UserController@getAddressIndex')->where('id', '[0-9]+');
        Route::get('/assistant/changeAddress/{id}','UserController@changeAddress')->where('id', '[0-9]+');

        Route::post('/assistant/user/delAddress','UserController@delAddress');
        Route::post('/assistant/user/changeAddress', 'UserController@userChangeAddress');
        Route::post('/assistant/user/addAddress', 'UserController@userAddAddress');

        Route::get('/assistant/loginOut', 'UserController@userLoginOut');
        Route::get('/assistant/sosoIndex', 'SearchController@viwSearch');
        Route::get('/assistant/goodsAll/{id}/{cid}','SearchController@goodsAll')->where('id', '[0-9]+')->where('cid','[0-9]+');
        Route::get('/assistant/order', 'UserController@order');
        Route::get('/assistant/search/{string}', 'SearchController@search');
        Route::get('/assistant/searchAll/{string}', 'SearchController@searchAll');
        Route::get('/assistant/searchGoods/{string}', 'SearchController@goodsSearch');
        Route::get('/assistant/goodsAjax/{id}', 'SearchController@goodsAjax')->where('id', '[0-9]+');
        Route::get('/assistant/goodsAjaxCount/{id}', 'SearchController@goodsAjaxCount')->where('id', '[0-9]+');
        Route::get('/assistant/wuLai/{id}', 'SearchController@wuLai')->where('id', '[0-9]+');
        Route::get('/assistant/goodsPromotion/{id}', 'SearchController@goodsPromotion')->where('id', '[0-9]+');


        /**
         * 购物车
         */
        Route::get('/assistant/shop', 'ShoppingCartController@index');
        Route::get('/assistant/shop/del/{id}', 'ShoppingCartController@shopDel')->where('id', '[0-9]+');
        Route::get('/assistant/shop/count', 'ShoppingCartController@getShopCount');
        Route::get('/assistant/shop/change/{id}/{zhis}', 'ShoppingCartController@change')->where('id', '[0-9]+')->where('zhis', '[0-9]+');
        Route::post('/assistant/shop/add', 'ShoppingCartController@addShop');
        Route::get('/assistant/getShop', 'ShoppingCartController@indexAjax');
        Route::get('/assistant/index/shopCount', 'ShoppingCartController@indexShopCount');

        /**
         * 商品
         */
        Route::get('/assistant/getGoods/{id}', 'GoodsInfoController@getGoods')->where('id', '[0-9]+');

        /**
         * 订单
         */
        Route::get('/assistant/order/create', 'OrderController@createOrder');
        Route::get('/assistant/order/pay', 'OrderController@pay');
    });
});
