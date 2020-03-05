<?php

namespace app\common\validate;

use think\Validate;

class CeshiValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'username'=>'require', // 需要用户传入的参数，必须带有username的数值的。
        'email' => 'require|email' // 还需要一个email, 而且必须是email格式，否则会报错。
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'username.require'=>'用户名不能为空',
        'email.require'=>'邮箱不能为空',
        'email.email'=>'邮箱格式不正确'
    ];
}
