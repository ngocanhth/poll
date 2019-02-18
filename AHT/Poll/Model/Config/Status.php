<?php
namespace AHT\Poll\Model\Config;
use Magento\Framework\Option\ArrayInterface;
// use Magento\Backend\App\Action\Context;
// use AHT\Poll\Model\PollFactory;
class Status implements ArrayInterface{
	const ENABLED =1;
	const DISABLED = 0;

	// protected $_pollFactory;

	// public function __construct(
					
	// 				PollFactory $pollFactory){
		
	// 	$this->_pollFactory=$pollFactory;
	// }


	public function toOptionArray(){
		// $pollModel = $this->_objectManager->create("AHT\Poll\Model");
		// var_dump($pollModel); die();
	//	$pollModel=$this->_pollFactory->create();
	//	var_dump($pollModel); die();

		return [
			self::ENABLED => __("Active"),
			self::DISABLED => __("Close")
		];
	}
}