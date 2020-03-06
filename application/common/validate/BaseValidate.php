<?php
namespace app\common\validate;

use think\Validate;

use app\lib\exception\BaseException;

class BaseValidate extends Validate {

    public function goCheck($scene='') {
        // 获取请求传递过来的所有参数
        $params = request()->param();

        // 开始验证
        // $result为局部变量，仅能在函数内部使用
        if(empty($scene)) {
            $result = $this->check($params);
        } else {
            $result = $this->scene($scene)->check($params);
        }
        // $result = empty($scene) ? $this->check($params) : $this->scene($scene)->check($params);
        if(!$result) {
            throw new BaseException([
                'msg'=>$this->getError(), 
                'errorCode'=>10000, 
                'code'=>400
                ]);
        }
        return true;
    }

}