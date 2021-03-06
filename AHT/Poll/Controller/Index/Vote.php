<?php
namespace AHT\Poll\Controller\Index;
use Magento\Framework\Controller\ResultFactory; //redirect về trang hiện tại
class Vote extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_pollFactory;
	protected $_pollAnswerFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\AHT\Poll\Model\PollFactory $pollFactory,
		\AHT\Poll\Model\PollanswerFactory $pollanswer
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_pollFactory = $pollFactory;
		$this->_pollAnswerFactory = $pollanswer;
		return parent::__construct($context);
	}


			public function execute(){
			$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT); //redirect về trang hiện tại
			$request=$this->getRequest();
		
			if($request->getPost()){
			//	$answerModel=$this->_PollanswerFactory->create();
			//	$answerId=$request->getParam("answer_id");

				//$pollId=$request->getParam("poll_id");

			//	var_dump($pollId); die();

				$formData=$request->getPostValue();
					// echo "<pre>";
					// print_r($formData);
					// echo "</pre>";
					// die();
						
				foreach ($formData as $pollId => $answer_id) {
				//	echo $answer_id."<br/>";
				// echo "<pre>";
				// 	print_r($formData);
				// 	echo "</pre>";
				// 	die();

				$poll = $this->_pollFactory->create()->load($pollId);
				$pollAnswer = $this->_pollAnswerFactory->create()->load($answer_id);
			// 	echo "<pre>";
			// print_r( $this->_pollAnswerFactory->create()->getCollection()->addFieldToFilter('poll_id', $pollId)->getData());
			// 	echo "</pre>";
			//  die(); 
			 $PollId_Collection = $this->_pollAnswerFactory->create()->getCollection()->addFieldToFilter('poll_id', $pollId)->getData();
			 $tottal_votes = 0;
			 foreach ($PollId_Collection as $answer) {
			 		$tottal_votes += (int)$answer["votes_count"];
			 }
// echo  $tottal_votes;
	
// die();
			//	 var_dump($pollAnswer->getData()); die();

				$votes_count = (int)$pollAnswer["votes_count"]+1;
				$votes_count_total = $tottal_votes+1;




				$pollAnswer->addData([
					"votes_count" => $votes_count,
					"poll_id"	=> $pollId 
				]);
				$poll->addData([
					"votes_count" => $votes_count_total
				]);
					$pollAnswer->save();
					$poll->save();
				}
			//	return $this->_redirect("*");

					// echo "<pre>";
					// print_r($formData);
					// echo "</pre>";
					// die();
					
				

		        // Your code

		        $resultRedirect->setUrl($this->_redirect->getRefererUrl()); //redirect về trang hiện tại
		        return $resultRedirect;

		}
	}
}

