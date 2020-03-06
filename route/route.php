<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// Route::get('think', function () {
//     return 'hello,ThinkPHP5! 22223333';
// });

// Route::get('hello/:name', 'index/hello');

// return [

// ];


// 不需要验证Token
Route::group('api/:version/', function(){
    // 发送验证码
    Route::post('user/sendcode', 'api/:version.UserController/sendCode');
    // 手机登录
    Route::post('user/phonelogin', 'api/:version.UserController/phoneLogin');
});
// 如果需要权限验证需要加上：
// ->middleware(['ApiUserAuth']);
