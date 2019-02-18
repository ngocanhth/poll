<?php
namespace AHT\Blog\Controller\Index;
class Delete extends \Magento\Framework\App\Action\Action{
	public function execute(){
		echo "<h2> Xóa bài post</h2>";
	
		$id = $this->getRequest()->getParam('id');
		$model=$this->_objectManager->create("AHT\Blog\Model\Post");
		$data=$model->load($id);
		$data->delete();

		 return $this->_redirect('*/*/');
	}
}

