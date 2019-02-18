<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	public function __construct(Context $context, PageFactory $pageFactory){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
	}
	public function execute(){

		$resultPage=$this->_resultPageFactory->create();
		$resultPage->setActiveMenu("AHT_Poll::poll"); //Để menu sáng lên
		$resultPage->getConfig()->getTitle()->prepend(__("Poll Manager"));


		// $poll_title=["Theo bạn đội tuyển nào sẽ vô địch Asian cup 2019 ?","Đội tuyển Việt Nam có vô địch thế giới không ?"];
		// $votes_count=["vanteo@gmail.com","vantun@yahoo.com","tungtran@gmail.com","hoailam@gmail.com","quangphong@yahoo.com"];
		// $phone=["0903354595","0999351247","113","011746565","016565154"];
		// $position=["Director","Worker","Shipper","Support","Shipper"];
		// $avatar=["student/abc.jpg","student/bcd.jpg","student/cde.jpg","student/def.jpg","student/efi.jpg"];
		// for($i=0;$i<1;$i++){
		// 	$studentModel=$this->_objectManager->create("AHT\Poll\Model\Poll");
		// 	$studentModel->addData([
		// 		"poll_title" => $name[$i],
		// 		"votes_count" => $email[$i],
		// 		"phone" => $phone[$i],
		// 		"position" => $position[$i],
		// 		"avatar" => $avatar[$i],
			
		// 	])->save();
		// }

		return $resultPage;
	}
}