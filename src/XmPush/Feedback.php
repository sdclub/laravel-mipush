<?php
/**
 * 获取失效的regId列表.
 * @author wangkuiwei
 * @name Feedback
 * @desc 获取失效的regId列表。
 *
 */
namespace Sdclub\MiPush\XmPush;

class Feedback extends HttpBase {
	
	public function __construct(){
		parent::__construct();
	}
	
        public function getInvalidRegIds($retries=1){
		$url = Constants::fetch_invalid_regids_url;
		$result = $this->getResult($url, array(), $retries);
		return $result;
	}
	
}

?>
