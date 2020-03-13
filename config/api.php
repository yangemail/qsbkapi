<?php

return[
    // token失效时间，0代表永不失效
    'token_expire'=>0,
    // 阿里大于
    'aliSMS'=>[
        'isopen'=>false, // 开启阿里大于
        'accessKeyId'=> '', //'<accessKeyId>',
        'accessSecret'=> '', //'<accessSecret>',
        'regionId'=>'cn-hangzhou',
        'product'=>'Dysmsapi',
        'version'=>'2017-05-25',
        'SignName'=>'', //'<YourSignName>',
        'TemplateCode'=>'', //'<YourTemplateCode>',
        // 验证码有效期，验证码发送时间间隔（60秒）
        'expire'=>30, // default: 60
    ],
];