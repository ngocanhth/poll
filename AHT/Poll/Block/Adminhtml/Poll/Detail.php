<?php
namespace AHT\Poll\Block\Adminhtml\Poll;
class Detail extends \Magento\Framework\View\Element\Template
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}

	public function getPoll()
	{

		$id = $this->getRequest()->getParam('id');
        $model=$this->_objectManager->create("AHT\Poll\Model\Poll");
        $data=$model->load($id);
   
		$poll = $data->getData("poll_title");
		   //  var_dump(); die();
	}
}
