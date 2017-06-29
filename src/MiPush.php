<?php 
namespace Sdclub\MiPush;

use Illuminate\Config\Repository;
use Sdclub\MiPush\XmPush\Builder;
use Sdclub\MiPush\XmPush\IOSBuilder;
use Sdclub\MiPush\XmPush\HttpBase;
use Sdclub\MiPush\XmPush\Sender;
use Sdclub\MiPush\XmPush\Constants;
use Sdclub\MiPush\XmPush\Stats;
use Sdclub\MiPush\XmPush\Tracer;
use Sdclub\MiPush\XmPush\Feedback;
use Sdclub\MiPush\XmPush\DevTools;
use Sdclub\MiPush\XmPush\Subscription;
use Sdclub\MiPush\XmPush\TargetedMessage;

class MiPush extends Sender {

    private $android;
    private $ios;
    private $retries;

    /**
     * 初始化配置
     * @author Jamie<327240570@qq.com>
     * @since  2016-12-16T21:23:24+0800
     * @param  Repository               $config [description]
     */
    public function __construct(Repository $config) {
        $conf = $config['mipush'];
        $this->ios = $conf['ios'];
        $this->android = $conf['android'];
        $this->retries = $conf['retries'];
    }

    /**
     * 根据regId发送通知
     * @author Jamie<327240570@qq.com>
     * @since  2016-12-17T04:34:39+0800
     * @param  string                   $regId   [description]
     * @param  array                    $data    [description]
     * @param  string                   $client  [description]
     * @param  integer                  $retries [description]
     * @return [type]                            [description]
     */
    public function send_id($regId = '', $data = [], $client = 'android', $retries = 1) {
    	if ($client == 'ios') {
    		$message = $this->build_ios($data);
    	} else {
    		$message = $this->build_androud($data);
    	}
    	$sender = new Sender();
    	return $sender->send($message, $regId)->getRaw();
    }

    /**
     * 根据regIds多条发送
     * @author Jamie<327240570@qq.com>
     * @since  2016-12-17T05:17:07+0800
     * @param  [type]                   $regIds  [description]
     * @param  [type]                   $data    [description]
     * @param  string                   $client  [description]
     * @param  integer                  $retries [description]
     * @return [type]                            [description]
     */
    public function send_ids($regIds, $data, $client = 'android', $retries = 1) {
		
	}

	/**
	 * 指定别名单发
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-17T05:23:16+0800
	 * @param  [type]                   $alias   [description]
	 * @param  [type]                   $data    [description]
	 * @param  string                   $client  [description]
	 * @param  integer                  $retries [description]
	 * @return [type]                            [description]
	 */
	public function send_alias($alias, $data, $client = 'android', $retries = 1) {
		
	}

	/**
	 * 指定别名列表群发
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-17T05:23:40+0800
	 * @param  [type]                   $alias   [description]
	 * @param  [type]                   $data    [description]
	 * @param  string                   $client  [description]
	 * @param  integer                  $retries [description]
	 * @return [type]                            [description]
	 */
	public function send_aliases($alias, $data, $client = 'android', $retries = 1) {
		
	}

	/**
	 * 指定topic群发
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-17T05:23:54+0800
	 * @param  [type]                   $topic   [description]
	 * @param  [type]                   $data    [description]
	 * @param  string                   $client  [description]
	 * @param  integer                  $retries [description]
	 * @return [type]                            [description]
	 */
	public function broadcast_topic($topic, $data, $client = 'android', $retries = 1) {
		
	}

	/**
	 * 向所有设备发送消息
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-17T05:24:34+0800
	 * @param  [type]                   $client  [description]
	 * @param  integer                  $retries [description]
	 * @return [type]                            [description]
	 */
	public function broadcast_all($client, $retries = 1) {
		
	}

	/**
	 * 检测定时任务是否存在
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-17T05:24:46+0800
	 * @param  [type]                   $msgId   [description]
	 * @param  integer                  $retries [description]
	 * @return [type]                            [description]
	 */
	public function check_schedule_job_exist($msgId, $retries = 1) {
		
	}

	/**
	 * 删除定时任务
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-17T05:24:59+0800
	 * @param  [type]                   $msgId [description]
	 * @return [type]                          [description]
	 */
	public function delete_schedule_job($msgId) {
		
	}

	/**
	 * 获取指定ID的消息状态
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-17T05:28:49+0800
	 * @return [type]                   [description]
	 */
	public function get_message_status_by_id() {

	}

	/**
	 * 构建发送给Android设备的Message对象
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-17T05:10:47+0800
	 * @param  array                    $data [description]
	 * @return [type]                         [description]
	 */
	private function build_androud($data = []) {
		// 常量设置必须在new Sender()方法之前调用
		Constants::setPackage($this->android['bundle_id']);
		Constants::setSecret($this->android['app_secret']);
		$message = new Builder();
		if(isset($data['is_through']) && $data['is_through'] == 1) {
			$message->passThrough(1);
		} else {
			$message->title($data['title']);  // 通知栏的title
			$message->description($data['description']); // 通知栏的descption
			$message->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
		}
		
		$message->payload(json_encode($data['payload'])); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
		$message->extra(Builder::notifyEffect, 1); // 此处设置预定义点击行为，1为打开app
		$message->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
		$message->notifyId($data['notify_id']); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
		$message->build();
		// 	构建要发送的消息内容和消息的发送目标
		$targetMessage = new TargetedMessage();
		$targetMessage->setTarget('alias1', TargetedMessage::TARGET_TYPE_ALIAS); // 设置发送目标。可通过regID,alias和topic三种方式发送
		$targetMessage->setMessage($message);
		return $message;
	}

	/**
	 * 构建发送给IOS设备的Message对象
	 * @author Jamie<327240570@qq.com>
	 * @since  2016-12-17T05:11:08+0800
	 * @param  array                    $data [description]
	 * @return [type]                         [description]
	 */
	private function build_ios($data = []) {
		// 常量设置必须在new Sender()方法之前调用
		Constants::setPackage($this->ios['bundle_id']);
		Constants::setSecret($this->ios['app_secret']);
		$message = new IOSBuilder();
		$message->description($data['description']);
		$message->soundUrl('default');
		$message->badge('4');
		$message->extra('payload', $data['payload']);
		$message->build();
		return $message;
	}
}