<?php 
namespace Sdclub\MiPush;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Config;
use Sdclub\MiPush\XmPush\Builder;
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

    public function send($regId, $data, $client = 'android', $retries = 1) {
    	
    }

    public function sendToIds($regIds, $data, $client = 'android', $retries = 1) {
		
	}

	public function sendToAlias($alias, $data, $client = 'android', $retries = 1) {
		
	}

	public function sendToAliases($alias, $data, $client = 'android', $retries = 1) {
		
	}

	public function broadcast($topic, $data, $client = 'android', $retries = 1) {
		
	}

	public function broadcastAll($client, $retries = 1) {
		
	}

	public function checkScheduleJobExist($msgId, $retries = 1) {
		
	}

	public function deleteScheduleJob($msgId) {
		
	}
}
