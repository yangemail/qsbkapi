<?php

namespace app\common\model;

use think\Model;
use think\facade\Cache;

use app\lib\exception\BaseException;
use app\common\controller\AliSMSController;

class User extends Model
{
    // 自动写入时间，数据表必须有一个列命名为create_time
    protected $autoWriteTimestamp = true;

    //发送验证码
    public function sendCode() {
        // 获取用户提交的手机号码
        $phone = request()->param('phone');
        // 判断是否已经发送过（验证码）
        if(Cache::get($phone)) {
            throw new BaseException(['code'=>200, 'msg'=>'你操作的太快了', 'errorCode'=>30001]);
        }
        // 生成4位验证码
        $code = random_int(1000, 9999);
        // 判断是否开启验证码功能
        if(!config('api.aliSMS.isopen')) {
            Cache::set($phone, $code, \config('api.aliSMS.expire')); 
            throw new BaseException(['code'=>200, 'msg'=>'验证码: '.$code,  'errorCode'=>30005]);
        }
        // 发送验证码
        $res = AliSMSController::SendSMS($phone, $code);
        // 发送成功，写入缓存
        if($res['Code'=='OK']){
            return Cache::set($phone, $code, config('api.aliSMS.expire'));
        }
        // 无效号码
        if($res['Code']=='isv.MOBILE_NUMBER_ILLEGAL') {
            throw new BaseException(['code'=>200, 'msg'=>'无效号码', 'errorCode'=>30002]);
        }
        // 触发日限制
        if($res['Code']=='isv.DAY_LIMIT_CONTROL') {
            throw new BaseException(['code'=>200, 'msg'=>'今日你已经发送超过限制，改日再来', 'errorCode'=>30003]);
        }
        // 发送失败
        throw new BaseException(['code'=>200, 'msg'=>'发送失败', 'errorCode'=>30004]);
    }

    // 绑定用户信息表（模型关联：一对一）
    public function userinfo() {
        return $this->hasOne('Userinfo');
    }

    // 判断用户是否存在
    public function isExist($arr=[]) {
        if(!is_array($arr)) {
            return false;
        }
        if(array_key_exists('phone', $arr)) { // 手机号码
            $user = $this->where('phone', $arr['phone'])->find();
            \halt($user);
            return $user;
        }
        return false;
    }

    // 手机登录
    public function phoneLogin() {
        // 获取所有参数
        $param = request()->param();
        // 验证用户是否存在
        $user = $this->isExist(['phone'=>$param['phone']]);
        // 用户不存在，直接注册
        if(!$user) {
            // 用户主表
            $user = self::create([
                'username'=>$param['phone'],
                'phone'=>$param['phone'],
                // 'password'=>password_hash($param['phone'], PASSWORD_DEFAULT)
            ]);
            // 在用户信息表创建对应的记录（用户存放"用户其他信息"，即：userinfo表）
            // user id就是上面创建好之后返回来的user id.
            $user->userinfo()->create(['user_id'=>$user->id]);
            return $this->CreateSaveToken($user->toArray());
        }
        // 用户是否被禁用
        $this->checkStatus($user->toArray());
    }
}
