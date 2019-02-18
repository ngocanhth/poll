<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Detail extends \Magento\Framework\App\Action\Action{

    protected $_pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
      //  echo "<h2> Add New Answer</h2>";
        $id = $this->getRequest()->getParam('id');
        $model=$this->_objectManager->create("AHT\Poll\Model\Poll");
        $data=$model->load($id);
        $poll = $data->getData("poll_title");
      //  echo $poll;

        return $this->_pageFactory->create();
    }


}