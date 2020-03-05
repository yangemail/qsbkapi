<?php

namespace app\api\controller\v1;

use think\Controller;
use think\Request;

use  app\common\controller\BaseController;
use app\common\validate\UserValidate;
use app\common\model\UserModel as UserModel;

class UserController extends BaseController
{
    // 发送验证码
    public function sendCode() {
        // 验证参数
        (new UserValidate())->goCheck('sendCode');
        // 发送验证码
        (new UserModel())->sendCode();

        return self::showResCodeWithoutData('发送成功');
    }
}
