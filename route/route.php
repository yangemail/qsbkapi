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

// Route::post('api/:v.user/sendcode','api/v1.UserController/sendCode');
// 发送验证码
Route::post('user/sendcode','api/v1.UserController/sendCode');