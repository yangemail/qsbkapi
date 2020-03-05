<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

use app\common\controller\BaseController;
use app\lib\exception\BaseException;
use app\common\validate\CeshiValidate;


class Index extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    // 账号密码登录
    public function index()
    {
        $list = [
            ['id'=>10, 'title'=>'123'],
            ['id'=>11, 'title'=>'321'],
        ];
        // return self::showResCode('获取成功', $list);
        return self::showResCodeWithoutData('获取成功2');
    }

   
}
