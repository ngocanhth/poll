<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Addanswer extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	//const ADMIN_RESOURCE = "QHOnline_Student::student_save";
	public function __construct(Context $context, PageFactory $pageFactory){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
	}
	public function execute(){
		//   echo "string"; die();
		return $this->_forward("editanswer");
	}
}