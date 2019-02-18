<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\Poll\Model\PollFactory;
use Magento\Framework\Registry;
class Save extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	protected $_pollFactory;
	protected $_coreRegistry;
	const ADMIN_RESOURCE = "AHT_Poll::poll_save";
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
		//echo "text"; die();
		$request=$this->getRequest();	//Lấy request từ form đưa lên
		// echo "<pre>";
		// print_r($request->getPost());
		// echo "</pre>";
		// die();

		if($request->getPost()){
			$pollModel=$this->_pollFactory->create();
			$pollId=$request->getParam("poll_id"); //teeb input: name="poll_id", trong trường hợp này form truyền bằng phương thức post nên tham số truyền vào getParam là name của ô input poll_id ->xem bên form edit
			$formData=$request->getPostValue(); //Lấy giá trị submit từ form qua phương thức Post

		//	var_dump($formData); die();

//var_dump($pollId); die();
			///	$request=$this->getRequest();
			

			$urlRedirect="*/*/add";

			//Nếu có id thì update không có id thì thêm mới

			if($pollId){
				$pollModel->load($pollId);
				$urlRedirect="*/*/edit/id/".$pollModel->getId();
			}

				// echo "<pre>";
				// print_r($formData);
				// echo "</pre>";
				// die();
			$pollModel->setData($formData); //nếu là thêm mới thì chỉ đơn giản là lấy giá trị từ form $formData=$request->getPostValue(); rồi lưu vào bảng thông qua $pollModel thôi

			$pollModel->save();
			$this->messageManager->addSuccess(__("The poll question information has been saved"));

			if($request->getParam("back")){
				return $this->_redirect("*/*/edit", ["id"=>$pollModel->getId(),"_current"=>true]);
			}

			return $this->_redirect("*/*/");
		}

	}
}