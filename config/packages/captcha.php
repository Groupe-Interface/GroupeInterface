<?php
// app/config/packages/captcha.php
if(!class_exists('CaptchaConfiguration')){return ;}
//BotDetect PHP Captcha configuration options
return [
    //Captcha configuration for exemple form
    'ExampleCaptchaUserRegistration'=>[
        'UserInputID'=>'captchaCode',
        'ImageWidth'=> 250,
        'ImageHeight'=>50,
    ]

];