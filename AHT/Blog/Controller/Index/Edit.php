<?php
namespace AHT\Blog\Controller\Index;

class Edit extends \Magento\Framework\App\Action\Action{

    public function execute(){
        echo "<h2> Update Record</h2>";
        $id = $this->getRequest()->getParam('id');
        $model=$this->_objectManager->create("AHT\Blog\Model\Post");
        $data=$model->load($id);
        $data->setName("Tieu de 999")
             ->setContent("Noi dung 999")
             ->setUrl_key("url key mới")
             ->save();
        exit();
    }

}