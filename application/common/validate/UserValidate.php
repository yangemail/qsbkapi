<?php

namespace app\common\validate;

use think\Validate;

class UserValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'phone'=>'require|mobile',
        'code'=>'require|number|length:4|isPerfectCode', // isPerfectCode为自定义方法，验证当前的验证码和发给用户的验证码是否相同。
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'phone.require'=>'请填写手机号码',
        'phone.mobile'=>'手机号码不合法',
    ];

    // 配置场景
    protected $scene = [
        // 发送验证码
        'sendCode'=>['phone'],
        // 手机号登录
        'phoneLogin'=>['phone', 'code']
    ];
}
