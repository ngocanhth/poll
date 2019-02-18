<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
class Delete extends \Magento\Backend\App\Action{
//	const ADMIN_RESOURCE = "QHOnline_Poll::poll_delete";
	public function execute(){
		$id = $this->getRequest()->getParam('id');
		if($id){
			$model=$this->_objectManager->create("AHT\Poll\Model\Poll");
			$model->load($id);
			if($model->getId()){
			//	$imageHelper=$this->_objectManager->get("AHT\poll\Helper\Image");
			//	$imageHelper->removeImage($model->getAvatar());
				$model->delete();
				$this->messageManager->addSuccess(__("This poll has been deleted"));
				return $this->_redirect('*/*/');
			}else{
				$this->messageManager->addError(__("This poll no longer exists"));
				return $this->_redirect('*/*/');
			}
			
		}else{
			$this->messageManager->addError(__("We can't find any id to delete"));
			return $this->_redirect('*/*/');
		} 
	}
}

