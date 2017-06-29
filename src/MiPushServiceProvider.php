<?php 
namespace Sdclub\MiPush;

use Illuminate\Support\ServiceProvider;

class MiPushServiceProvider extends ServiceProvider {

	/**
	 * 引导应用服务
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-16T21:09:51+0800
	 * @return [type]                   [description]
	 */
	public function boot() {
    	$this->publishes([
	        __DIR__ . '/config/mipush.php' => config_path('mipush.php'),
	    ]);
	}

	/**
	 * 注册应用服务。
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-16T21:09:31+0800
	 * @return [type]                   [description]
	 */
	public function register() {
        $this->app->singleton('mipush', function ($app) {
            return new MiPush($app['config']);//config
        });
	}
	
    /**
     * 获取提供者提供的服务
     * @author Jamie<327240570@qq.com>
     * @since  2016-12-16T21:09:21+0800
     * @return [type]                   [description]
     */
    public function provides() {
        return ['mipush'];
    }
}