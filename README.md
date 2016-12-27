# laravel-mipush
小米推送laravel扩展包, 根据官方最新SDK包整理

#安装方法
    1、在项目目录下 composer require sdclub/laravel-mipush
       或在 composer.json 中添加 "sdclub/laravel-mipush": "^1.0" 然后 composer update
       如果无法安装 请执行一下 composer update nothing 然后 composer update

    2、在config/app.php
       'providers' 中添加 Sdclub\MiPush\MiPushServiceProvider::class,
       'aliases'   中添加 'MiPush' => Sdclub\MiPush\Facades\MiPush::class,

    3、执行 php artisan config:cache 清空配置缓存
       执行 php artisan vendor:publish --provider="Sdclub\MiPush\MiPushServiceProvider" 将配置文件发布到config文件夹中

    4、配置 config/mipush.php

#使用方法（待完善）
    在控制器中 
    use MiPush;
    
    在方法中
    public function index() {
        $regId = 'regId'; //你数据库中存储的regId
        $data = ['notify_id' => 123, 'title' => '这是一个标题', 'description' => '推送texts', 'payload' => []];

        //这个是只针对 Android的推送 自己选择使用
        MiPush::send_id($regId, $data, 'android');
        //这个是只针对 ios的推送 自己选择使用
        MiPush::send_id($regId, $data, 'ios');
    }

其它用法直接参考MiPush 类中的写法 后面会整理规范一些.
