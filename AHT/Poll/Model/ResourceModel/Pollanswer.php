<?php
namespace AHT\Poll\Model\ResourceModel;
class Pollanswer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
	protected function _construct(){
		$this->_init("poll_answer","answer_id");
	}
}