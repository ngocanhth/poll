<?php
namespace AHT\Poll\Block\Poll;
use \Magento\Framework\View\Element\Template\Context;
use AHT\Poll\Model\PollFactory;
use \AHT\Poll\Model\ResourceModel\Pollanswer\CollectionFactory;
class ActivePoll extends \Magento\Framework\View\Element\Template
{
	protected $_pageFactory;
	protected $_pollFactory;
	protected $_pollanswerCollection;
	//protected $_templates
	public function __construct(
				Context $context, 
				PollFactory $pollFactory,
				CollectionFactory $PollanswerCollection
				){
	parent::__construct($context);
	$this->_pollFactory=$pollFactory;
	$this->_pollanswerCollection=$PollanswerCollection;
}

	 public function showListPoll()
    {
  		$poll = $this->_pollFactory->create();
		$pollCollection = $poll->getCollection();
		return $pollCollection;
    }

    public function getPoll()
    {
    	$poll = $this->_pollFactory->create();
    	return $poll;
    }

       public function getListPollAnswer($pollId)
    {
    	 $collection = $this->_pollanswerCollection->create()->addFieldToFilter('poll_id', $pollId);
       	 return $collection;
    }

    //   public function getPercent()
    // {
    // 	$pollAnsersId = $this->getListPollAnswer();

    // 	foreach ($pollAnsersId as $pollAnswer) {
    // 		echo $pollAnswer["votes_count"];
    // 	}
       	


    // }


       public function getCountPollAnswer($pollId)
    {
    	 $collection = $this->_pollanswerCollection->create()->addFieldToFilter('poll_id', $pollId)->count();
       	 return $collection;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->setTemplate('AHT_Poll::active.phtml');
        return $this;
    }

    //     protected function setPollTemplate()
    // {

    //     $this->setTemplate('AHT_Poll::active.phtml');
    //     return $this;
    // }


    //    public function getListPollAnswer()
    // {
    // 	 $collection = $this->_pollanswerCollection->create();
    //    	 return $collection;
    // }


    // public function getPollData($pollId)
    // {
    //     if (empty($pollId)) {
    //         return false;
    //     }
    //     $poll = $this->_pollFactory->load($pollId);

    //     $pollAnswers = Mage::getModel('poll/poll_answer')
    //         ->getResourceCollection()
    //         ->addPollFilter($pollId)
    //         ->load()
    //         ->countPercent($poll);

    //     // correct rounded percents to be always equal 100
    //     $percentsSorted = array();
    //     $answersArr = array();
    //     foreach ($pollAnswers as $key => $answer) {
    //         $percentsSorted[$key] = $answer->getPercent();
    //         $answersArr[$key] = $answer;
    //     }
    //     asort($percentsSorted);
    //     $total = 0;
    //     foreach ($percentsSorted as $key => $value) {
    //         $total += $value;
    //     }
    //     // change the max value only
    //     if ($total > 0 && $total !== 100) {
    //         $answersArr[$key]->setPercent($value + 100 - $total);
    //     }

    //     return array(
    //         'poll' => $poll,
    //         'poll_answers' => $pollAnswers,
    //         'action' => Mage::getUrl('poll/vote/add', array('poll_id' => $pollId, '_secure' => true))
    //     );
    // }
    
    //  public function setPollTemplate($template, $type)
    // {
    //     $this->_templates[$type] = $template;
    //     return $this;
    // }
}

