<?php
namespace AHT\Poll\Model;
class Pollanswer extends \Magento\Framework\Model\AbstractModel{
	protected function _construct(){
		$this->_init("AHT\Poll\Model\ResourceModel\Pollanswer");
	}
}