<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\Poll\Model\PollFactory;
use AHT\Poll\Model\PollanswerFactory;
use Magento\Framework\Registry;
class Saveanswer extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	protected $_PollFactory;
	protected $_PollanswerFactory;
	protected $_coreRegistry;
	const ADMIN_RESOURCE = "AHT_Poll::poll_save";
	public function __construct(
					Context $context, 
					PageFactory $pageFactory,
					PollFactory $PollFactory,
					PollanswerFactory $PollanswerFactory,
					Registry $registry){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
		$this->_PollFactory=$PollFactory;
		$this->_PollanswerFactory=$PollanswerFactory;
		$this->_coreRegistry = $registry;
	}
	public function execute(){
	//	echo "text"; die();
		$request=$this->getRequest();



	
		if($request->getPost()){

			$answerId=$request->getParam("answer_id");

			$pollId=$request->getParam("poll_id");

		//	echo $pollId; die();

			$answerModel=$this->_PollanswerFactory->create();
			$pollModel=$this->_PollFactory->create()->load($pollId);


		//	var_dump($pollModel->getData("votes_count")); die();

			$formData=$request->getPostValue();

			//	$request=$this->getRequest();
			

			$urlRedirect="*/*/addanswer";
			if($answerId){
				$answerModel->load($answerId);
				$urlRedirect="*/*/editanswer/id/".$answerModel->getId();
			}

				// echo "<pre>";
				// print_r($formData);
				// echo "</pre>";
				// die();
			//	var_dump($pollModel["votes_count"]); die();

		//	$answerModel->setData($formData);
			$votes_count = (int)$formData["votes_count"]; //votes_count chính là tên name="votes_count"
			$votes_count_total = $votes_count +(int)$pollModel["votes_count"];

		//	echo $votes_count_total; die();
	
	//		echo $votes_count; die();

			$answerModel->setData([
				"poll_id" => $pollId,
				"answer_title" =>$formData["answer_title"],
				"votes_count" =>$votes_count
			]);

			$pollModel->addData([
					"votes_count" => $votes_count_total 
				]);

	//		$formFile=$request->getFiles()->toArray();		

			$answerModel->save();
			$pollModel->save();
			$this->messageManager->addSuccess(__("The poll answer information has been saved"));

			if($request->getParam("back")){
				return $this->_redirect("*/*/edit", ["id"=>$answerModel->getId(),"_current"=>true]);
			}

			return $this->_redirect("*/*/");
		}

	}
}