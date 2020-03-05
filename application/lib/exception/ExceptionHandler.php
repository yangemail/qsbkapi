<?php
namespace app\lib\exception;

use Exception;
use think\exception\Handle;

class ExceptionHandler extends Handle {

    public $code;
    public $msg;
    public $errorCode;

    // 自定义类需要继承think\exception\Handle并且实现render方法
    public function render(Exception $e){
        // halt($e);

        if($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        } else {
            // app.app_debug开启，显示默认的异常
            if(config('app.app_debug')) {
                return parent::render($e);
            }

            $this->code = 500;
            $this->msg = '服务器异常';
            $this->errorCode = 999;
        }

        $res = [
            // 'code'=>$this->code,
            'msg'=>$this->msg,
            'errorCode'=>$this->errorCode
        ];
        

        return json($res, $this->code);
    }
}