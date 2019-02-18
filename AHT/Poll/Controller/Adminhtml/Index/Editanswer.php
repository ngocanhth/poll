<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\Poll\Model\PollFactory;
use AHT\Poll\Model\PollanswerFactory;
use Magento\Framework\Registry; //Để truyền model từ Block sang form
class Editanswer extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	protected $_pollFactory;
	protected $_pollanswerFactory;
	protected $_coreRegistry;
//	const ADMIN_RESOURCE = "QHOnline_Student::student_save";
	public function __construct(
					Context $context, 
					PageFactory $pageFactory,
					PollFactory $pollFactory,
					PollanswerFactory $pollanswerFactory,
					Registry $registry){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
		$this->_pollFactory=$pollFactory;
		$this->_pollanswerFactory=$pollanswerFactory;
		$this->_coreRegistry = $registry;
	}
	public function execute(){
		$pollId=$this->getRequest()->getParam("id");
		$pollModel=$this->_pollFactory->create()->load($pollId);
		$pollAnswerModel=$this->_pollanswerFactory->create();

//	var_dump($pollId); die();

		if($pollId){
			//$pollAnswerModel->load($pollId);
//var_dump($pollAnswerModel->getId()); die();

			// if(!$pollAnswerModel->getId()){
			// 	$this->messageManager->addError(__("This poll answer no longer exists"));
			// 	return $this->_redirect("*/*/");
			// }
			$title="Add Poll Answer: ".$pollModel->getPollTitle();
		}else{
			$this->messageManager->addError(__("Select a poll to add new answer"));
			return $this->_redirect("*/*/");
		}

		$data=$this->_session->getFormData(true); //Đẩy giá trị ra form để khi lưu giá trị người dùng nhập vào ko bị mất data, giữ lại giá trị form khi submit
		if(!empty($data)){
			$pollAnswerModel->setData($data);
		}
		$this->_coreRegistry->register("pollanswer",$pollAnswerModel); //Đưa đối tượng model vào registry
		$resultPage=$this->_resultPageFactory->create();
		$resultPage->setActiveMenu("AHT_Poll::poll");
		$resultPage->getConfig()->getTitle()->prepend(__($title));


		return $resultPage;
	}
}