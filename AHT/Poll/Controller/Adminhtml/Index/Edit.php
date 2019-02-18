<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\Poll\Model\PollFactory;
use Magento\Framework\Registry; //Để truyền model từ Block sang form
class Edit extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	protected $_pollFactory;
	protected $_coreRegistry;
//	const ADMIN_RESOURCE = "QHOnline_Student::student_save";
	public function __construct(
					Context $context, 
					PageFactory $pageFactory,
					PollFactory $pollFactory,
					Registry $registry){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
		$this->_pollFactory=$pollFactory;
		$this->_coreRegistry = $registry;
	}
	public function execute(){
		$pollId=$this->getRequest()->getParam("id"); //trị số id nếu là truyền bằng phương thức get thì nó là tên key của tham số trên url (ví dụ: http://127.0.0.1/magento2/admin/poll/index/edit/poll_id/2/  => thì phải truyền vào getParam("poll_id")), nếu truyền bằng phương thức post thì nó là name của input

	//	var_dump($pollId); die();

		$model=$this->_pollFactory->create();
		if($pollId){
			$model->load($pollId);
			if(!$model->getId()){
				$this->messageManager->addError(__("This poll no longer exists")); //Đây là truong hợp người dùng gõ trực tiếp đường dẫn có id nhưng id không có trong bảng, ví dụ: http://127.0.0.1/magento2/admin/poll/index/edit/id/27676453525/
				return $this->_redirect("*/*/");	//Không có id thì điều hướng về trang trước đó, tức trang list poll và kèm thông báo lỗi This poll no longer exists
			}
			$title="Edit A Poll: ".$model->getPollTitle();
		}else{
			$title="Add A New Poll";
		}
		$data=$this->_session->getFormData(true); //Lấy giá trị trên form lưu vào session người dùng nhập vào ko bị mất data, giữ lại giá trị form khi submit. Khi 1 trường không nhập data mà yêu cầu "required" => true nếu không lưu vào sesion và đổ lại cho form thì mất công nhập lại

		// echo "<pre>";
		// var_dump($data); die();
		// echo "<pre/>";

		if(!empty($data)){ //Nếu form có data thì mới lưu không thì thôi, không cho submit
			$model->setData($data);
		}
		$this->_coreRegistry->register("poll",$model); //Đưa đối tượng model vào registry và thông qua registry truyền sang form edit
		$resultPage=$this->_resultPageFactory->create();
		$resultPage->setActiveMenu("AHT_Poll::poll");
		$resultPage->getConfig()->getTitle()->prepend(__($title));


		return $resultPage;
	}
}