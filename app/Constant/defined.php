<?php

/**
 * login
 */
define('LOGIN_SUCCESS', '登录成功');
define('LOGIN_FAILED', '用户名或密码错误');

/**
 * token
 */
define('TOKEN_FAILED', 'token验证失败，拒绝访问！');
define('TOKEN_SUCCESS', 'token验证成功');
define('TOKEN_OVERTIME', 'token过期，请重新登录！');

/**
 * mysql
 */
define('MODEL_FAILED','系统忙请稍后再试');

/**
 * email
 */
define('RETRIEVE_PASSWORD',1);

/**
 * status code
 */
define('VERIFY_TIMEOUT',5401);//验证码超时
define('PLEASE_DO_NOT_MULTIPLE_REQUEST',5402);//不要重复请求
define('VERIFY_FAILED',5403);//验证码错误
define('PASSWORD_FAILED',5404);//密码错误
define('PASS_FAILED',5405);//密码错误